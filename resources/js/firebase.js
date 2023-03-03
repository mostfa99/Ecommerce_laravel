// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyC8GaNuuhC1Ok5J6F57qMm9M3qce2wk2s0",
    authDomain: "ecommercelaravel-32c4f.firebaseapp.com",
    projectId: "ecommercelaravel-32c4f",
    storageBucket: "ecommercelaravel-32c4f.appspot.com",
    messagingSenderId: "743917545237",
    appId: "1:743917545237:web:ebf16324e7215cfcd66b1c",
    measurementId: "G-E701HPWE3V"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
const messaging = getMessaging();
getToken(messaging, { vapidKey: 'BDBlqEmmUJoCQmAksJa04vvV95Yp77yv150GKTDd2ouE2eiuBIqwBkmyIG2wo4nrWoW6nimeWKNbuFbPjO4p2Pg' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        console.log("Data Loaded: " + currentToken)
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});

onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    // ...
});
