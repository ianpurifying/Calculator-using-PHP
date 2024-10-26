<?php

/*
    APP: CALCULATOR USING PHP
    CREATED BY: IAN PURIFICACION
    PURPOSE: NONE, PHP practice hehe
*/

// Function to get the user's input for valid number
function getNumberInput($prompt) {
    while (true) {
        echo $prompt;
        $input = trim(fgets(STDIN));

        if (is_numeric($input)) {
            return (float)$input;
        } else {
            echo "⚠️Please enter a valid number.\n";
        }
    }
}

// Function to get user's input for operator
function getOperatorInput() {
    echo "Choose an operator(+, -, *, /, %, **, sqrt, abs, log, sin, cos, tan, fact, exit): ";
    return trim(fgets(STDIN));
}

// Function for calculation
function calculate($num1, $num2, $operator) {
    switch ($operator) {
        case "+":
            return $num1 + $num2;
        case "-":
            return $num1 - $num2;
        case "*":
            return $num1 * $num2;
        case "/":
            return ($num2 == 0) ? "❌ ERROR! Cannot divide by ZERO" : $num1 / $num2;
        case "%":
            return ($num2 == 0) ? "❌ ERROR! Division by ZERO" : $num1 % $num2;
        case "**":
            return $num1 ** $num2;
        case "sqrt":
            return ($num1 < 0) ? "❌ ERROR! Square root of a negative number is undefined" : sqrt($num1);
        case "abs":
            return abs($num1);
        case "log":
            return ($num1 <= 0) ? "❌ ERROR! Logarithm for non-positive numbers is undefined" : log($num1);
        case "sin":
            return sin(deg2rad($num1));
        case "cos":
            return cos(deg2rad($num1));
        case "tan":
            return tan(deg2rad($num1));
        case "fact":
            return ($num1 < 0) ? "❌ ERROR! Factorial of a negative number is undefined" : factorial($num1);
        default:
            return "❌ Invalid operator! Please enter the correct one.";
    }
}

// Function for factorial calculation
function factorial($num) {
    if ($num == 0) {
        return 1;
    }
    $result = 1;
    for ($i = 1; $i <= $num; $i++) {
        $result *= $i;
    }
    return $result;
}

// Function to handle multiple calculations
function runCalculator() {
    // Prompt the user
    while (true) {
        $num1 = getNumberInput("Enter the first number: ");

        $operator = getOperatorInput();
        
        // Check if the user wants to exit
        if (strtolower($operator) == "exit") {
            echo "Goodbye!\n";
            break;
        }
        
        // Handle single operand operations
        if (in_array($operator, ["sqrt", "abs", "log", "sin", "cos", "tan", "fact"])) {
            $result = calculate($num1, null, $operator);
        } else {
            // Get the second number for binary operations
            $num2 = getNumberInput("Enter the second number: ");
            $result = calculate($num1, $num2, $operator);
        }

        // Print the result
        echo "\n==================================================\n";
        echo "🎯 RESULT: $result\n";
        echo "==================================================\n";

        // Ask if the user wants another calculation
        echo "\nDo you want to perform another calculation? (y/n): ";
        $continue = trim(fgets(STDIN));
        if (strtolower($continue) !== "y") {
            echo "Goodbye!\n";
            break;
        }
    }
}

runCalculator();
?>