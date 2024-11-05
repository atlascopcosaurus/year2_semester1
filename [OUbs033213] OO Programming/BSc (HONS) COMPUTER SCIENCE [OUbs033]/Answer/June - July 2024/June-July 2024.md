### Question 1 (25 marks)

#### a) What do each of the following print? (5 marks)

1. `System.out.println(22 + "rs");`
   - **Output:** "22rs"
   - Reason: `22` is an integer, and `"rs"` is a string. The `+` operator concatenates them, converting `22` to a string.

2. `System.out.println(22 + 3 + "rs");`
   - **Output:** "25rs"
   - Reason: `22 + 3` is evaluated first because of left-to-right associativity, resulting in `25`. Then, `25` is concatenated with `"rs"`.

3. `System.out.println((22+3) + "rs");`
   - **Output:** "25rs"
   - Reason: Parentheses cause `22 + 3` to be evaluated first, giving `25`. Then, `25` is concatenated with `"rs"`.

4. `System.out.println("rs" + (22+3));`
   - **Output:** "rs25"
   - Reason: The expression in parentheses (`22 + 3`) is evaluated first, yielding `25`. Then, `"rs"` is concatenated with `25`.

5. `System.out.println("rs" + 22 + 3);`
   - **Output:** "rs223"
   - Reason: Since `"rs"` is a string, everything after it is concatenated as strings. First, `"rs" + 22` becomes `"rs22"`, and then `"rs22" + 3` becomes `"rs223"`.

#### b) Missing code for summing two numbers input from the keyboard. (15 marks)

```java
import java.util.Scanner;

public class Test {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        
        System.out.print("Enter first number: ");
        int num1 = input.nextInt();
        
        System.out.print("Enter second number: ");
        int num2 = input.nextInt();
        
        int sum = num1 + num2;
        System.out.println("The sum is: " + sum);
    }
}
```

#### c) Syntax for a function in Java. (5 marks)

```java
public returnType functionName(parameterType parameterName) {
    // function body
    return value; // optional, based on returnType
}
```

Example:

```java
public int add(int a, int b) {
    return a + b;
}
```

---

### Question 2 (25 marks)

#### a) Differentiate between a class and an object using an example. (6 marks)

- **Class:** A class is a blueprint or template for creating objects. It defines properties (attributes) and methods (functions).
  - Example: `class Car { int speed; void accelerate() { speed += 10; } }`
  
- **Object:** An object is an instance of a class, created using the `new` keyword.
  - Example: `Car myCar = new Car();`

#### b) Three steps when creating an object from a class. (6 marks)

1. **Declaration:** Declare the class type (e.g., `Car myCar;`).
2. **Instantiation:** Create an instance using the `new` keyword (e.g., `myCar = new Car();`).
3. **Initialization:** Initialize the object, setting its initial state (e.g., `myCar.speed = 0;`).

#### c) Using inheritance to represent object-oriented sentences. (9 marks)

```java
public class Animal {
}

public class Mammal extends Animal {
}

public class Reptile extends Animal {
}

public class Dog extends Mammal {
}
```

Explanation:
- Animal is the superclass.
- Mammal and Reptile inherit from Animal.
- Dog inherits from Mammal, showing the hierarchy.

#### d) Code to call an interface in class `Animal`. (4 marks)

```java
interface Behaviour {
    void eat();
}

public class Animal implements Behaviour {
    public void eat() {
        System.out.println("Animal is eating.");
    }
}
```

---

### Question 3 (25 marks)

#### a) Define an exception and how it is handled. (6 marks)

- **Exception:** An exception is an event that occurs during the execution of a program and disrupts the normal flow of instructions.
- **Handling:** Exceptions are handled using `try-catch` blocks. Code that might throw an exception is placed in the `try` block, and the `catch` block handles the exception.

#### b) What type of exception has occurred in the given code? (3 marks)

- **Exceptions:**
  1. `ArrayIndexOutOfBoundsException`
  2. `ArithmeticException`

#### c) Output of the given code. (8 marks)

The code results in two outputs:

1. The ArithmeticException occurs when dividing by zero (`num1/num2` where `num2 = 0`).
   - Output: `Can't divide by zero`

2. The `for` loop causes an `ArrayIndexOutOfBoundsException` at index `i = 3`.
   - Output: `Array is out of bounds`

#### d) Handle the exception using `throws`. (8 marks)

```java
public class Main {
    public static void main(String[] args) throws ArithmeticException, ArrayIndexOutOfBoundsException {
        int array[] = {20, 20, 40};
        int num1 = 15, num2 = 0;
        int result = 10;

        result = num1 / num2;
        System.out.println("The result is " + result);

        for (int i = 5; i >= 0; i--) {
            System.out.println("The value of array is " + array[i]);
        }
    }
}
```

---

### Question 4 (25 marks)

#### a) Define an array. (1 mark)

- An array is a collection of elements of the same data type, stored at contiguous memory locations.

#### b) i) Size of the array. (2 marks)

- **Size:** 10

#### ii) Values at index 2. (2 marks)

- **Value at index 2:** 3

#### iii) Write the missing code for the for loop to display sum. (10 marks)

```java
for (int i = 0; i < my_array.length; i++) {
    sum += my_array[i];
    System.out.println("The sum is " + sum);
}
```

#### iv) Loop to display array elements with index. (10 marks)

```java
for (int i = 0; i < my_array.length; i++) {
    System.out.println("Element at index " + i + ": " + my_array[i]);
}
```
