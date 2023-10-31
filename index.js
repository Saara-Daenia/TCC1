function menuMobile() {
    var menu = document.getElementById('menu-mobile');
    menu.classList.toggle('active');
}

// Carrossel de imagens e lupa de ampliação
let slideIndex = 0;
const slides = document.querySelectorAll(".slide");
const carousel = document.querySelector(".carousel");
const magnifier = document.createElement("div");
magnifier.classList.add("magnifier");
document.body.appendChild(magnifier);

showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex + n);
}

function currentSlide(n) {
    showSlides(n);
}

function showSlides(n) {
    if (n >= slides.length) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = slides.length - 1;
    } else {
        slideIndex = n;
    }

    carousel.style.transform = `translateX(-${slideIndex * 100}%)`;
}

const anterior = document.getElementById("anterior");
const proximo = document.getElementById("proximo");

anterior.addEventListener("click", () => {
    plusSlides(-1);
});

proximo.addEventListener("click", () => {
    plusSlides(1);
});

slides.forEach((slide, index) => {
    slide.addEventListener("click", () => currentSlide(index));
    slide.addEventListener("mouseenter", () => {
        magnifier.style.backgroundImage = `url(${slide.src})`;
        magnifier.style.display = "block";
    });
    slide.addEventListener("mousemove", (e) => {
        const rect = slide.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        magnifier.style.backgroundPosition = `-${x * 2}px -${y * 2}px`;
        magnifier.style.left = e.pageX + 10 + "px";
        magnifier.style.top = e.pageY + 10 + "px";
    });
    slide.addEventListener("mouseleave", () => {
        magnifier.style.display = "none";
    });
});
