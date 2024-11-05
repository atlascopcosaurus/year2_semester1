Here are the **test case scenarios** that cover various parts of the `MauriBankLoanCalculator` and its interaction with the loan types. These test cases are designed to validate both successful paths and potential error conditions.

### **Test Case Scenarios for MauriBankLoanCalculator:**

#### **1. User Input Validation**
- **Test Case 1.1**: Validate that the user's age is between 18 and 65.
  - **Input**: Age = 17
  - **Expected Output**: Error message: "You must be between 18 and 65 years old to be eligible for a loan."
  
- **Test Case 1.2**: Validate that the user's age is exactly 18.
  - **Input**: Age = 18
  - **Expected Output**: Proceed with the loan application process.

- **Test Case 1.3**: Validate that the user's age is exactly 65.
  - **Input**: Age = 65
  - **Expected Output**: Proceed with the loan application process.

- **Test Case 1.4**: Validate that the user's age is over 65.
  - **Input**: Age = 66
  - **Expected Output**: Error message: "You must be between 18 and 65 years old to be eligible for a loan."

#### **2. Loan Term Validation**
- **Test Case 2.1**: Validate that the loan term is greater than 0 years and less than or equal to the maximum loan term based on the user's age.
  - **Input**: Age = 40, Loan Term = 20 years
  - **Expected Output**: Proceed with the loan application process.

- **Test Case 2.2**: Validate that the loan term is negative.
  - **Input**: Loan Term = -5 years
  - **Expected Output**: Error message: "Invalid loan term. Loan term must be positive."

- **Test Case 2.3**: Validate that the loan term exceeds the maximum allowed based on the user's age.
  - **Input**: Age = 50, Loan Term = 20 years
  - **Expected Output**: Error message: "Invalid loan term. You can only repay your loan over a maximum of 15 years."

#### **3. Loan Amount Validation**
- **Test Case 3.1**: Validate that the loan amount is greater than 0.
  - **Input**: Loan Amount = 0
  - **Expected Output**: Error message: "Loan amount must be greater than zero."

- **Test Case 3.2**: Validate that the loan amount is a valid positive number.
  - **Input**: Loan Amount = 265000
  - **Expected Output**: Proceed with the loan application process.

#### **4. Loan Type Selection**
- **Test Case 4.1**: Validate that the user selects a valid loan type (1 for Home Loan, 2 for Car Loan, 3 for Personal Loan).
  - **Input**: Loan Type = 1 (Home Loan)
  - **Expected Output**: Proceed with the creation of a Home Loan object.

- **Test Case 4.2**: Validate that the user selects an invalid loan type.
  - **Input**: Loan Type = 4
  - **Expected Output**: Error message: "Invalid loan type selected. Please choose a valid option (1, 2, or 3)."

#### **5. Loan Creation**
- **Test Case 5.1**: Validate that a `HomeLoan` object is created successfully when the user selects Home Loan.
  - **Input**: Loan Type = 1, Loan Amount = 200000, Loan Term = 20 years
  - **Expected Output**: A `HomeLoan` object is created with the correct loan amount, loan term, and a 5.0% interest rate.

- **Test Case 5.2**: Validate that a `CarLoan` object is created successfully when the user selects Car Loan.
  - **Input**: Loan Type = 2, Loan Amount = 150000, Loan Term = 5 years
  - **Expected Output**: A `CarLoan` object is created with the correct loan amount, loan term, and a 6.5% interest rate.

- **Test Case 5.3**: Validate that a `PersonalLoan` object is created successfully when the user selects Personal Loan.
  - **Input**: Loan Type = 3, Loan Amount = 50000, Loan Term = 3 years
  - **Expected Output**: A `PersonalLoan` object is created with the correct loan amount, loan term, and an 8.0% interest rate.

#### **6. Monthly Payment Calculation**
- **Test Case 6.1**: Validate that the monthly payment is calculated correctly for a Home Loan.
  - **Input**: Loan Type = 1 (Home Loan), Loan Amount = 200000, Loan Term = 20 years
  - **Expected Output**: Correct monthly payment based on the 5.0% interest rate.

- **Test Case 6.2**: Validate that the monthly payment is calculated correctly for a Car Loan.
  - **Input**: Loan Type = 2 (Car Loan), Loan Amount = 150000, Loan Term = 5 years
  - **Expected Output**: Correct monthly payment based on the 6.5% interest rate.

- **Test Case 6.3**: Validate that the monthly payment is calculated correctly for a Personal Loan.
  - **Input**: Loan Type = 3 (Personal Loan), Loan Amount = 50000, Loan Term = 3 years
  - **Expected Output**: Correct monthly payment based on the 8.0% interest rate.

#### **7. Error Handling**
- **Test Case 7.1**: Validate that the system handles invalid input for loan type (non-integer values).
  - **Input**: Loan Type = "ABC" (non-integer input)
  - **Expected Output**: Error message: "Invalid input. Please enter the correct data type."

- **Test Case 7.2**: Validate that the system handles invalid input for loan amount (non-numeric values).
  - **Input**: Loan Amount = "ABC" (non-numeric input)
  - **Expected Output**: Error message: "Invalid input. Please enter the correct data type."

#### **8. General System Behavior**
- **Test Case 8.1**: Validate that the system terminates properly when invalid input is provided multiple times.
  - **Input**: Age = 66, Loan Type = 4, Loan Amount = -50000
  - **Expected Output**: The system displays multiple error messages and terminates the loan process.

- **Test Case 8.2**: Validate that the system successfully completes the loan process from start to finish with valid input.
  - **Input**: Age = 30, Loan Type = 1, Loan Amount = 200000, Loan Term = 15 years
  - **Expected Output**: The system successfully calculates and displays the monthly payment and loan details.

---

These test cases cover most of the critical paths and edge cases in the `MauriBankLoanCalculator` application, ensuring that it behaves as expected under both normal and exceptional circumstances. Each scenario tests a specific part of the system, from input validation to loan creation and monthly payment calculation.