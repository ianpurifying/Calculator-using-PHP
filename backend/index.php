<?php

/*
    APP: CALCULATOR USING PHP
    CREATED BY: IAN PURIFICACION
*/

// Function to get the USER's input for a valid number
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

// Function to get USER's input for operator
function getOperatorInput() {
    echo "Choose an operator(+, -, *, /, %, **, sqrt, abs, log, exit): ";
    return trim(fgets(STDIN));
}

// Function to calculate basic math
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
            return sqrt($num1);
        case "abs":
            return abs($num1);
        case "log":
            return ($num1 <= 0) ? "❌ ERROR! Logarithm for non-positive numbers is undefined" : log($num1);
        default:
            return "❌ Invalid operator! Please enter the correct one.";
    }
}

// Function to handle multiple calculations
function runCalculator() {
    //Prompt the user
    while (true) {
        $num1 = getNumberInput("Enter the first number: ");

        $operator = getOperatorInput();
        
        // Check if user wants to exit
        if (strtolower($operator) == "exit") {
            echo "Goodbye!\n";
            break;
        }
        
        // Check for single operand operations
        if ($operator == "sqrt" || $operator == "abs" || $operator == "log") {
            $result = calculate($num1, null, $operator);
        } else {
            // Get second number for binary operations
            $num2 = getNumberInput("Enter the second number: ");
            $result = calculate($num1, $num2, $operator);
        }

        // Print the result
        echo "\n==================================================\n";
        echo "🎯 RESULT: $result\n";
        echo "==================================================\n";

        // Prompt the user wants another calculation
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