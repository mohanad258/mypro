   
   import { initializeApp } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
   import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-analytics.js";

  const firebaseConfig = {
    apiKey: "AIzaSyDWoSf8uyn1rMMCCa4g97XfQw2KewA-Xac",
    authDomain: "test-cb303.firebaseapp.com",
    projectId: "test-cb303",
    storageBucket: "test-cb303.firebasestorage.app",
    messagingSenderId: "825718626629",
    appId: "1:825718626629:web:542bba0e881d6cfb22c62c"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

 