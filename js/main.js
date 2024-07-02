var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}


// button show/hide chi tiết sản phẩm
const toggleContent = document.querySelector(".product-info--continue")
if(toggleContent) {
    toggleContent.addEventListener("click", content)
}

function content() {
    const content = document.querySelector(".product-info__content")
    content.classList.toggle("hide-content")

    if (content.classList.contains("hide-content")) {
        toggleContent.innerHTML = "Xem Thêm <i class='fas fa-chevron-down'></i>"
    } else {
        toggleContent.innerHTML = "Thu gọn <i class='fas fa-chevron-up'></i>"
    }
}

