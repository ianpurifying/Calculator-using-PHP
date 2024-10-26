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
  const lastChar = display.value.slice(-1);

  if (
    (isOperator(value) && isOperator(lastChar)) ||
    (isOperator(value) && display.value === "")
  ) {
    return;
  }

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
  } catch (error) {
    display.value = "Error: Calculation failed";
  }
};

// Function to validate the input expression
const isValidExpression = (expression) => {
  const cleanedExpression = expression.replace(/[^0-9\+\-\*\/\(\)\.√]/g, "");
  return cleanedExpression === expression; // Ensure no invalid characters remain
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
