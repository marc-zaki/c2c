document.addEventListener("DOMContentLoaded", () => {
    const questions = document.querySelectorAll(".faq-question");

    questions.forEach(question => {
        question.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent default behavior
            question.classList.toggle("active");
            const answer = question.nextElementSibling;
            const icon = question.querySelector(".icon");

            if (answer.style.display === "block" || answer.style.display === "") {
                answer.style.display = "none";
                icon.textContent = "+";
            } else {
                answer.style.display = "block";
                icon.textContent = "-";
            }
        });
    });
});
