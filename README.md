# Ticket Simulation Website

This project presents a website where users can simulate the purchase of event tickets. The focus is the backend functionality, NOT the frontend.

**Right at the beginning, you will be prompted to accept cookies and give access to location. The cookies are for session management and the location is used to show you data about the sunset and sunrise given your latitude and longitude.**

![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/50769de4-6614-432e-ac48-9f585bd220f4)

**After you accept, it will look like this:**

![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/fa0479da-e583-4497-a6f6-1ac881991f5e)

**Then you can register and start buying tickets on the events page:**

![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/b258bd15-1d26-4c38-b87a-af0608ddad6f)


**Add tickets to cart and "buy" them:**

![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/04127958-e649-40fb-a9b7-72fe0c2f20bc)

**Admin dashboard which is only available to admins, they can add events and promote/demote users:**

![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/e33770e9-870d-4d04-9714-3c4c768ff7e5)
![image](https://github.com/vladimirsgit/ticket-buying/assets/120330142/10a5b108-7a5f-4095-ab8e-fbe7ce72bc4e)

**For a more detailed overview, please read further**

## Features

- **User Registration**: To access ticket purchasing, you first need to register. Your registration is confirmed via an email validation process.
- **Profile Update**: After registration, you can update your profile and even delete it. If you forgot your password, you can change it from the login page.
- **Ticket Purchasing**: You can add tickets to your cart, "purchase", and then receive your tickets as PDFs on email.

## Backend

- **Technology**: The backend is written using plain PHP.
- **Database Management**: For handling database actions I used Doctrine ORM.
- **Security**: Implemented basic security measures. These include validating user input and ensuring that POST requests align with the database to protect the server, protecting the forms against spoofing, using Google's RECAPTCHA API, and making sure that the connection is HTTPS.

## Deployment

- **Platform**: The code has been deployed on the Google Cloud Platform.
