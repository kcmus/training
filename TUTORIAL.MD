# Principles of OOP: Part 1

The terms and definitions used throughout this document match those definitions as implemented by the PHP programming language.

This material makes the assumption that you already have PHP, Composer, Docker, and the Symfony CLI installed and configured.

*Objective:* Insert test data into the database.

*Goal:* To create an extendable toolset that can be used to insert test data into the database. The tools need to be as abstract, and agnostic, as possible to allow for reusability and extendability.

To reach the goals and accomplish the objective, the Doctrine ORM will be used. For the purposes of this tutorial, specific tools that already exist which accomplish these goals will not be used in order to help facilitate the different principles behind Object Oriented Programming.

**NOTE:** Refer to the README.md for setting up the project.

## Concepts

- Classes
- Objects
- Abstraction
- Encapsulation
- Inheritance
- Polymorphism
- Dynamic Binding
- Message Passing

## Classes

User-Defined data types.
Consists of data members and member functions which can be accessed by creating an instance of a class.
A class can be considered a blueprint for an object.
An instantiated class is an object.

### Q&A
1. Can a class exist without properties?
    - Technically, yes. However, a class is a data type that is used to represent objects of related data and properties are necessary to represent the data.
2. Can a class exist without member functions, or methods?
    - Yes. Properties of a class have three types of visibility: public, protected, and private. Public properties do not need member functions to expose them for manipulation.
    - Abstract classes are also a good example for this use case.

## Objects

An object is a class that represents a real-world instance of a class.

```php
$chevyCorvette = new Car('Chevrolet', 'Corvette');
```

## Abstraction

Abstraction involves the provisioning of information about the data to the outside world.
 
With abstraction, you can *abstract* the implementation details of a class, effectively hiding those details that aren't necessary for an operator to know.

Does the operator of a car, when pressing down the accelerator, care about the details of how the fuel gets from the gas tank to the engine so the car can accelerate?
Does the operator of the car care how pressing the brake causes brake fluid to flow through brake lines to create pressure that causes the brake pads to press against the rotors of the car to slow down or come to a stop?

## Encapsulation

Also known as *data-hiding*. Encapsulation is the practice of making class properties or member functions from being accessed from outside the owning object.

This is where the visibility of member functions and properties is important: Private, Protected, and Public.

Private properties and member functions cannot be accessed from external objects, or even from objects which inherit functionality from the class.

## Inheritance

Inheritance is a huge pillar of the OOP world. This concept involves the derivation of class properties and member functions from other classes.

Consider a class called *animal* and two other classes called *cat* and *dog*. Common attributes and member functions should be removed from *cat* and *dog* and placed into *animal*. The *cat* and the *dog* can then extend *animal*, therefore, inheriting the common functionality of an animal.

## Polymorphism

Polymorphism describes the ability of an object to mutate while being of the same base object as another similar class.

Take the *cat* and *dog* example previously described. In PHP, the *animal* class could implement a public method called *speak*.

The *cat* and *dog* classes, being extended from *animal* inherit the speak method and, by default, speak the same language.

With polymorphism in PHP, the *cat* and *dog* classes can override the *speak* method so that *dog* objects speak dog language (bark!) and that *cat* objects speak cat language (meow).

## Dynamic Binding

The code to be executed in response to the function call is decided at runtime, or the code associated with the given procedure call is not known until the time of the call at runtime.

Take into consideration some derived class *cat* having all the members of its base class *animal*. Once *cat* is not hiding any of the public members of *animal*, then *cat* can represent *animal* in any context where *animal* could be used.

This is also know as subtype polymorphism.

## Message Passing

The primary form of communication between objects in OOP. Objects send to and receive from, messages to each other. This is another way to say that you specify a name for an object, the name of the function, and the information to be sent.

Classes have names.
Classes can have arguments, which are defined in the class constructor.
Methods, or functions, have names.
Methods, or functions, can have arguments, which are defined in the method signature.
