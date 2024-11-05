# Class Diagram
```
@startuml
abstract class Loan {
    - loanAmount: double
    - loanTerm: int
    - interestRate: double
    + Loan(loanAmount: double, loanTerm: int)
    + calculateMonthlyPayment(): double
    + getLoanType(): String
    + getInterestRate(): double
    # setInterestRate(): void
}

class HomeLoan {
    + HomeLoan(loanAmount: double, loanTerm: int)
    + setInterestRate(): void
    + getLoanType(): String
}

class CarLoan {
    + CarLoan(loanAmount: double, loanTerm: int)
    + setInterestRate(): void
    + getLoanType(): String
}

class PersonalLoan {
    + PersonalLoan(loanAmount: double, loanTerm: int)
    + setInterestRate(): void
    + getLoanType(): String
}

class MauriBankLoanCalculator {
    + main(args: String[]): void
    - userName: String
    - age: int
    - loanChoice: int
    - loanAmount: double
    - loanTerm: int
    + promptUserForDetails(): void
    + validateInput(): void
    + createLoan(loanChoice: int): Loan
    + calculateMonthlyPayment(loan: Loan): double
}

Loan <|-- HomeLoan
Loan <|-- CarLoan
Loan <|-- PersonalLoan
MauriBankLoanCalculator --> Loan : creates
@enduml

```


# Sequence Diagram

```
@startuml
actor User as U
participant "MauriBankLoanCalculator" as MBC
participant "Loan" as Loan
participant "HomeLoan" as HL
participant "CarLoan" as CL
participant "PersonalLoan" as PL

U -> MBC: Start Loan Process
MBC -> U: Prompt User for Details
U -> MBC: Provide Name, Age, Loan Type
MBC -> MBC: Validate User Input

alt Invalid Age
    MBC -> U: Show Error Message
    return
else Valid Age
    MBC -> U: Prompt for Loan Amount and Term
    U -> MBC: Provide Loan Amount, Loan Term
    MBC -> MBC: Validate Loan Term
end

alt Invalid Loan Term
    MBC -> U: Show Error Message
    return
else Valid Loan Term
    MBC -> MBC: Create Loan based on Type
    alt Home Loan
        MBC -> HL: Create HomeLoan Object
        HL -> MBC: Return HomeLoan Object
    else Car Loan
        MBC -> CL: Create CarLoan Object
        CL -> MBC: Return CarLoan Object
    else Personal Loan
        MBC -> PL: Create PersonalLoan Object
        PL -> MBC: Return PersonalLoan Object
    end
    MBC -> Loan: calculateMonthlyPayment()
    Loan --> MBC: Return Monthly Payment
    MBC -> U: Display Loan Details and Monthly Payment
end
@enduml

```