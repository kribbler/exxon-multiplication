jQuery(document).ready(function() {
    var minutes = 0;
    var maxim_add = 49;
    var maxim_sub = 50;
    var maxim_sub_up = 50;
    var a;
    var b;
    var sign;
    var total = 0;
    var responded = false;
    var saved = 0;
    
    var snd_success = new Audio("audio/success.mp3");
    var snd_error = new Audio("audio/error.mp3");

    show_previous();
    generate();

    $('#check').click(function() {
        if (!$('#result').val()) {
            $('#result').addClass('forget');
            return false;
        }
        if ($('#check').hasClass('disabled')) {
            return false;
        }
        var number_1 = $('#show_number_1').html();
        var number_2 = $('#show_number_2').html();
        var sign = $('#show_sign').html();
        var result = $('#result').val();

        var calc = eval(number_1 + sign + number_2);
        if (calc != result) {
            snd_error.play();
            $('#response').html('<div class="bdanger">F<br />A<br />I<br />L</div>');
            $('.sad').append('<img src="img/sad.png" width="50%" />');
            minutes = minutes-1;
        } else {
            snd_success.play();
            $('#response').html('<div class="bsuccess"> A<br />W<br />E<br />S<br />O<br />M<br />E</div>');
            $('.sad').append('<img src="img/happy.png" width="50%" />');
            minutes = minutes+1;
        }
        $('#minutes').html(minutes);
        $('#response').fadeIn();
        $('#again').show();
        if (total != result) {
            tr_style = 'adanger';
        } else {
            tr_style = 'asuccess';
        }
        $('#result').removeClass('forget');
        $('#results').append(
            "<div class='"+tr_style+"'><span>" + a + " " + sign + " " + b + "</span><span> = " + result + "</span></div>"
        );
        $('#check').addClass('disabled');
        responded = true;

        var url = 'exercises/save';
        var data = {
            "saved" : saved ,
            "correct" : (calc == result) ? 1 : 0,
        };
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: success,
            error: error,
            async: true,
            dataType: 'text'
        });

        function success(data) {
            saved = 1;
            console.log(data);
        }
        function error(data) {
        }
    });

    $(document).keyup(function(event){
        if(event.keyCode == 13){
            if (!responded)
                $("#check").click();
            else 
                $("#again").click();
        }
    });

    $('#again').click(function(){
        responded = false;
        $('#check').removeClass('disabled');
        $('#response').fadeOut();
        generate();
    });

    function generate() {
        $('#result').focus();
        $('#result').val('');
        $('#again').hide();
        
        sign = Math.floor(Math.random() * 2) + 0;
        if (sign == 1) {
            sign = "-";
        } else {
            sign = "+";
        }

        if (sign == '-') {
            maxim = maxim_sub;
            a = Math.floor(Math.random() * maxim) + 5;
            b = Math.floor(Math.random() * maxim_sub_up) + 1;
        } else {
            maxim = maxim_add;
            a = Math.floor(Math.random() * maxim) + 5;
            b = Math.floor(Math.random() * maxim) + 5;
        }
        

        if (sign == '-') {
            if (a >= b ) {
                total = eval(a + sign + b);        
            } else {
                total = eval(b + sign + a);
            }
        } else {
            total = eval(a + sign + b);
        }

        if (a < b) {
            c = a;
            a = b;
            b = c;
        }

        $('#show_number_1').html(a);
        $('#show_number_2').html(b);
        $('#show_sign').html(sign);
        $('#minutes').html(minutes);
    }

    function show_previous()
    {
        $.ajax({
            type: "get",
            url: 'exercises/getPrevious',
            success: success,
            async: true,
        });

        function success(data) {
            var obj = jQuery.parseJSON(data);
            var total = 0;
            var correct = 0;
            $.each(obj, function(key,value) {
                $('#exercises').append(
                    "<tr><td>" + value.date + "</td><td>" + value.total + "</td><td>" + value.correct + "</td></tr>"
                );
                total += value.total;
                correct += value.correct;
            });
            $('#exercises').append(
                '<tfoot><tr><td></td><td>'+total+'</td><td>'+correct+'</td></tr></tfoot>'
            )
        }
    }
})