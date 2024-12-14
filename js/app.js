import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.2/firebase-app.js";
import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.17.2/firebase-auth.js";

const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_AUTH_DOMAIN",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_STORAGE_BUCKET",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID",
};

// تهيئة التطبيق
const app = initializeApp(firebaseConfig);

// تهيئة المصادقة
const auth = getAuth(app);

// التحكم في النموذج
const loginForm = document.getElementById("login-form");
const errorMessage = document.getElementById("error-message");

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    signInWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            const user = userCredential.user;
            alert("تم تسجيل الدخول بنجاح: " + user.email);
            // هنا يمكن إعادة التوجيه إلى الصفحة الرئيسية
            window.location.href = "home.html";
        })
        .catch((error) => {
            errorMessage.textContent = "خطأ: " + error.message;
        });
});



