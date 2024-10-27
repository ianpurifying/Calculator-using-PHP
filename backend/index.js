let isNewCalculation = false;

// Functions to determine if a character is an operator
const isOperator = (value) => {
  return [
    "+",
    "-",
    "*",
    "/",
    "%",
    "**",
    "√",
    "log",
    "sin",
    "cos",
    "tan",
    "fact",
  ].includes(value);
};

// Function to update the calculator display
const updateDisplay = (value) => {
  const display = document.getElementById("display");

  // If a new calculation is starting, clear the display for new input
  if (isNewCalculation && !isOperator(value)) {
    display.value = "";
    isNewCalculation = false;
  }

  const lastChar = display.value.slice(-1);

  // Prevent adding an operator if the last character is also an operator
  if (
    (isOperator(value) && isOperator(lastChar)) ||
    (isOperator(value) && display.value === "")
  ) {
    return;
  }

  // Update the display
  display.value += value;
};

// Function for calculation
const calculate = () => {
  const display = document.getElementById("display");
  const expression = display.value;

  if (!isValidExpression(expression)) {
    display.value = "Error: Invalid input";
    return;
  }

  try {
    // Evaluate the expression
    const result = eval(expression.replace(/√/g, "Math.sqrt"));
    display.value = result;
    isNewCalculation = true; // Set flag for a new calculation after displaying result
  } catch (error) {
    display.value = "Error: Calculation failed";
  }
};

// Function to validate the input expression
const isValidExpression = (expression) => {
  const cleanedExpression = expression.replace(/[^0-9+\-*/().√]/g, "");
  return cleanedExpression === expression; // Ensure no invalid characters remain
};

// Function to validate input in real-time
const validateInput = () => {
  const display = document.getElementById("display");
  const regex = /^[0-9+\-*/().√]*$/; // Regex for valid characters

  if (!regex.test(display.value)) {
    // Remove the last character if it doesn't match the regex
    display.value = display.value.slice(0, -1);
  }
};

// Function to remove the last character from the display
const backspace = () => {
  const display = document.getElementById("display");
  display.value = display.value.slice(0, -1);
};

// Clear the display if a new calculation is started
const clearDisplay = () => {
  const display = document.getElementById("display");
  display.value = "";
};

// Add event listener for keyboard input
document
  .getElementById("display")
  .addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      event.preventDefault(); // Prevent default action (like form submission)
      calculate(); // Call the calculate function when Enter is pressed
    }
  });
