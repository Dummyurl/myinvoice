<!-- popup css -->
<link href="<?php echo $this->config->item('css_url'); ?>popup.css" type="text/css" rel="stylesheet"/>

<a href="#modal"><img src="<?php echo $this->config->item('images_url'); ?>cal_icon.png" alt="" style="margin-left:2px;"/></a>
<div class="remodal" data-remodal-id="modal">
    <div id="calculator">
        <!-- Screen and clear key -->
        <div class="top">
            <span class="clear">C</span>
            <div class="screen"></div>
        </div>

        <div class="keys">
            <!-- operators and other keys -->
            <span>7</span>
            <span>8</span>
            <span>9</span>
            <span class="operator">+</span>
            <span>4</span>
            <span>5</span>
            <span>6</span>
            <span class="operator">-</span>
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span class="operator">÷</span>
            <span>0</span>
            <span>.</span>
            <span class="eval">=</span>
            <span class="operator">x</span>
        </div>
    </div>
</div>
<script src="<?php echo $this->config->item('js_url'); ?>popup.js" type="text/javascript" ></script>
<script>
    $(document).on('open', '.remodal', function () {
        console.log('open');
    });

    $(document).on('opened', '.remodal', function () {
        console.log('opened');
    });

    $(document).on('close', '.remodal', function () {
        console.log('close');
    });

    $(document).on('closed', '.remodal', function () {
        console.log('closed');
    });

    $(document).on('confirm', '.remodal', function () {
        console.log('confirm');
    });

    $(document).on('cancel', '.remodal', function () {
        console.log('cancel');
    });

    // You can open or close it like this:
    // var inst = $.remodal.lookup[$('[data-remodal-id=modal]').data('remodal')];
    // inst.open();
    // inst.close();

    // Or init in this way:
    var inst = $('[data-remodal-id=modal2]').remodal();
    // inst.open();
</script>

<!-- Calculator Js -->
<script>
// Get all the keys from document
    var keys = document.querySelectorAll('#calculator span');
    var operators = ['+', '-', 'x', '÷'];
    var decimalAdded = false;

// Add onclick event to all the keys and perform operations
    for (var i = 0; i < keys.length; i++) {
        keys[i].onclick = function (e) {
            // Get the input and button values
            var input = document.querySelector('.screen');
            var inputVal = input.innerHTML;
            var btnVal = this.innerHTML;

            // Now, just append the key values (btnValue) to the input string and finally use javascript's eval function to get the result
            // If clear key is pressed, erase everything
            if (btnVal == 'C') {
                input.innerHTML = '';
                decimalAdded = false;
            }

            // If eval key is pressed, calculate and display the result
            else if (btnVal == '=') {
                var equation = inputVal;
                var lastChar = equation[equation.length - 1];

                // Replace all instances of x and ÷ with * and / respectively. This can be done easily using regex and the 'g' tag which will replace all instances of the matched character/substring
                equation = equation.replace(/x/g, '*').replace(/÷/g, '/');

                // Final thing left to do is checking the last character of the equation. If it's an operator or a decimal, remove it
                if (operators.indexOf(lastChar) > -1 || lastChar == '.')
                    equation = equation.replace(/.$/, '');

                if (equation)
                    input.innerHTML = eval(equation);

                decimalAdded = false;
            }

            // Basic functionality of the calculator is complete. But there are some problems like 
            // 1. No two operators should be added consecutively.
            // 2. The equation shouldn't start from an operator except minus
            // 3. not more than 1 decimal should be there in a number

            // We'll fix these issues using some simple checks

            // indexOf works only in IE9+
            else if (operators.indexOf(btnVal) > -1) {
                // Operator is clicked
                // Get the last character from the equation
                var lastChar = inputVal[inputVal.length - 1];

                // Only add operator if input is not empty and there is no operator at the last
                if (inputVal != '' && operators.indexOf(lastChar) == -1)
                    input.innerHTML += btnVal;

                // Allow minus if the string is empty
                else if (inputVal == '' && btnVal == '-')
                    input.innerHTML += btnVal;

                // Replace the last operator (if exists) with the newly pressed operator
                if (operators.indexOf(lastChar) > -1 && inputVal.length > 1) {
                    // Here, '.' matches any character while $ denotes the end of string, so anything (will be an operator in this case) at the end of string will get replaced by new operator
                    input.innerHTML = inputVal.replace(/.$/, btnVal);
                }

                decimalAdded = false;
            }

            // Now only the decimal problem is left. We can solve it easily using a flag 'decimalAdded' which we'll set once the decimal is added and prevent more decimals to be added once it's set. It will be reset when an operator, eval or clear key is pressed.
            else if (btnVal == '.') {
                if (!decimalAdded) {
                    input.innerHTML += btnVal;
                    decimalAdded = true;
                }
            }

            // if any other key is pressed, just append it
            else {
                input.innerHTML += btnVal;
            }
            
            if (btnVal == '=') {
               $('#fAnnualRevenue').val($('.screen').html());
               $('#fRevenue').val($('.screen').html());
               $('.remodal').trigger('closed');
            }
            // prevent page jumps
            //e.preventDefault();
        }
    }
</script>