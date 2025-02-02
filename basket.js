function validateCreditCardForm() {
    const creditCard = document.getElementById("credit-card").value.trim();
    const cvv = document.getElementById("cvv").value.trim();
    const expiryDate = document.getElementById("expiry-date").value.trim();
    const currentDate = new Date();

    // בדיקת מספר כרטיס אשראי (16 ספרות)
    const cardRegex = /^[0-9]{16}$/;
    if (!cardRegex.test(creditCard)) {
        alert("מספר כרטיס האשראי צריך לכלול 16 ספרות בלבד.");
        return false;
    }

    // בדיקת CVV (3 ספרות בלבד)
    const cvvRegex = /^[0-9]{3}$/;
    if (!cvvRegex.test(cvv)) {
        alert("קוד CVV צריך לכלול 3 ספרות בלבד.");
        return false;
    }

    // בדיקת תאריך תפוגה (פורמט MM/YY)
    const expiryRegex = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;
    if (!expiryRegex.test(expiryDate)) {
        alert("תאריך התפוגה צריך להיות בפורמט MM/YY.");
        return false;
    }

    // בדיקה אם התאריך בתוקף
    const [month, year] = expiryDate.split("/").map(Number);
    const expiryFullDate = new Date(`20${year}`, month - 1);
    if (expiryFullDate < currentDate) {
        alert("כרטיס האשראי פג תוקף.");
        return false;
    }

    return true;
}