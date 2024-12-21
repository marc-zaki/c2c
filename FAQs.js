document.addEventListener("DOMContentLoaded", () =>{
  const questions = document.querySelectorAll(".faq-question");
  
  questions.forEach(question => {
    question.addEventListener("click", ()=> {
      question.classList.toggle("active");
      const answer = question.nextElementSibling;
      const icon = question.querySelector(".icon");
      
      if (answer.style.display === "block") {
        answer.style.display = "none";
        icon.textContent = "+";
      } else {
        answer.style.display = "block";
        icon.textContent ="-";
      }
    });
  });
  
});


