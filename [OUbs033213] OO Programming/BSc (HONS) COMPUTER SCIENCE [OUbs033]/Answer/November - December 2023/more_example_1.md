### Practice Questions

1. What does each of the following statements print?

   i) `System.out.println(5 + "hi");`  
   ii) `System.out.println(5 + 10 + "hi");`  
   iii) `System.out.println((5 + 10) + "hi");`  
   iv) `System.out.println("hi" + (5 + 10));`  
   v) `System.out.println("hi" + 5 + 10);`  

2. What does each of the following statements print?

   i) `System.out.println(3 * 2 + "apple");`  
   ii) `System.out.println(3 * (2 + "apple"));`  
   iii) `System.out.println("apple" + 3 * 2);`  
   iv) `System.out.println("apple" + (3 * 2));`  
   v) `System.out.println("apple" + 3 + 2);`  

3. What does each of the following statements print?

   i) `System.out.println(4 + 5 * "hello");`  
   ii) `System.out.println("hello" + 4 + 5);`  
   iii) `System.out.println("hello" + (4 + 5));`  
   iv) `System.out.println((4 + 5) + "hello");`  
   v) `System.out.println(4 * (5 + "hello"));`  

### Answers with Explanations

#### Set 1
1. i) `System.out.println(5 + "hi");`
   - **Output:** `5hi`
   - **Explanation:** `5` is converted to a string and concatenated with `"hi"`. The `+` operator is left-associative, so the integer `5` is treated as part of a string concatenation.

   ii) `System.out.println(5 + 10 + "hi");`
   - **Output:** `15hi`
   - **Explanation:** The addition of `5 + 10` is performed first (left-to-right), resulting in `15`, which is then concatenated with `"hi"`.

   iii) `System.out.println((5 + 10) + "hi");`
   - **Output:** `15hi`
   - **Explanation:** The parentheses force `5 + 10` to be evaluated first, resulting in `15`, which is then concatenated with `"hi"`.

   iv) `System.out.println("hi" + (5 + 10));`
   - **Output:** `hi15`
   - **Explanation:** The expression inside the parentheses `(5 + 10)` is evaluated first, producing `15`, and then concatenated with `"hi"`.

   v) `System.out.println("hi" + 5 + 10);`
   - **Output:** `hi510`
   - **Explanation:** `"hi"` is concatenated with `5`, resulting in `"hi5"`, and then `10` is concatenated, producing `"hi510"`.

#### Set 2
2. i) `System.out.println(3 * 2 + "apple");`
   - **Output:** `6apple`
   - **Explanation:** `3 * 2` is evaluated first due to higher precedence of `*`, resulting in `6`, which is then concatenated with `"apple"`.

   ii) `System.out.println(3 * (2 + "apple"));`
   - **Output:** `3 * 2apple`
   - **Explanation:** `2 + "apple"` is evaluated first, treating `2` as a string, resulting in `"2apple"`. Then `3 * "2apple"` results in a compilation error since Java does not allow multiplication with strings.

   iii) `System.out.println("apple" + 3 * 2);`
   - **Output:** `apple6`
   - **Explanation:** `3 * 2` is evaluated first due to higher precedence, resulting in `6`, which is then concatenated with `"apple"`.

   iv) `System.out.println("apple" + (3 * 2));`
   - **Output:** `apple6`
   - **Explanation:** Parentheses force `3 * 2` to be evaluated first, resulting in `6`, which is then concatenated with `"apple"`.

   v) `System.out.println("apple" + 3 + 2);`
   - **Output:** `apple32`
   - **Explanation:** `"apple"` is concatenated with `3`, resulting in `"apple3"`, and then `2` is concatenated, producing `"apple32"`.

#### Set 3
3. i) `System.out.println(4 + 5 * "hello");`
   - **Output:** Compilation error
   - **Explanation:** Multiplication of an integer by a string is not allowed in Java, so this results in a compilation error.

   ii) `System.out.println("hello" + 4 + 5);`
   - **Output:** `hello45`
   - **Explanation:** `"hello"` is concatenated with `4`, resulting in `"hello4"`, and then `5` is concatenated, producing `"hello45"`.

   iii) `System.out.println("hello" + (4 + 5));`
   - **Output:** `hello9`
   - **Explanation:** Parentheses force `4 + 5` to be evaluated first, resulting in `9`, which is then concatenated with `"hello"`.

   iv) `System.out.println((4 + 5) + "hello");`
   - **Output:** `9hello`
   - **Explanation:** The expression inside the parentheses `(4 + 5)` is evaluated first, producing `9`, which is then concatenated with `"hello"`.

   v) `System.out.println(4 * (5 + "hello"));`
   - **Output:** Compilation error
   - **Explanation:** `(5 + "hello")` results in a string, and multiplying an integer by a string is not allowed in Java, so this results in a compilation error. 

These examples should give you a good understanding of how operator precedence and associativity work in Java, especially in terms of evaluating arithmetic and string concatenation operations.