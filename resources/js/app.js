// require("./bootstrap");
import KeenSlider from "keen-slider/keen-slider";
import "keen-slider/keen-slider.min.css";
import Swiper from "swiper";
import axios from "axios";

// const bars = document.getElementById("nav-bars");
// const bar = document.getElementsByClassName("bar");
// // home
// if (bars) {
//     bars.addEventListener("click", () => {
//         document.querySelector("nav").classList.toggle("active");
//         bar[0].classList.toggle("act");
//         bar[1].classList.toggle("act");
//     });
//     // function navigation(slider) {
//     //     let wrapper, dots, arrowLeft, arrowRight;

//     //     function markup(remove) {
//     //         wrapperMarkup(remove);
//     //         dotMarkup(remove);
//     //         arrowMarkup(remove);
//     //     }

//     //     function removeElement(elment) {
//     //         elment.parentNode.removeChild(elment);
//     //     }
//     //     function createDiv(className) {
//     //         var div = document.createElement("div");
//     //         var classNames = className.split(" ");
//     //         classNames.forEach((name) => div.classList.add(name));
//     //         return div;
//     //     }

//     //     function arrowMarkup(remove) {
//     //         if (remove) {
//     //             removeElement(arrowLeft);
//     //             removeElement(arrowRight);
//     //             return;
//     //         }
//     //         arrowLeft = createDiv("arrow arrow--left");
//     //         arrowLeft.addEventListener("click", () => slider.prev());
//     //         arrowRight = createDiv("arrow arrow--right");
//     //         arrowRight.addEventListener("click", () => slider.next());

//     //         wrapper.appendChild(arrowLeft);
//     //         wrapper.appendChild(arrowRight);
//     //     }

//     //     function wrapperMarkup(remove) {
//     //         if (remove) {
//     //             var parent = wrapper.parentNode;
//     //             while (wrapper.firstChild)
//     //                 parent.insertBefore(wrapper.firstChild, wrapper);
//     //             removeElement(wrapper);
//     //             return;
//     //         }
//     //         wrapper = createDiv("navigation-wrapper");
//     //         slider.container.parentNode.appendChild(wrapper);
//     //         wrapper.appendChild(slider.container);
//     //     }

//     //     function dotMarkup(remove) {
//     //         if (remove) {
//     //             removeElement(dots);
//     //             return;
//     //         }
//     //         dots = createDiv("dots");
//     //         slider.track.details.slides.forEach((_e, idx) => {
//     //             var dot = createDiv("dot");
//     //             dot.addEventListener("click", () => slider.moveToIdx(idx));
//     //             dots.appendChild(dot);
//     //         });
//     //         wrapper.appendChild(dots);
//     //     }

//     //     function updateClasses() {
//     //         var slide = slider.track.details.rel;
//     //         slide === 0
//     //             ? arrowLeft.classList.add("arrow--disabled")
//     //             : arrowLeft.classList.remove("arrow--disabled");
//     //         slide === slider.track.details.slides.length - 1
//     //             ? arrowRight.classList.add("arrow--disabled")
//     //             : arrowRight.classList.remove("arrow--disabled");
//     //         Array.from(dots.children).forEach(function (dot, idx) {
//     //             idx === slide
//     //                 ? dot.classList.add("dot--active")
//     //                 : dot.classList.remove("dot--active");
//     //         });
//     //     }

//     //     slider.on("created", () => {
//     //         markup();
//     //         updateClasses();
//     //     });
//     //     slider.on("optionsChanged", () => {
//     //         console.log(2);
//     //         markup(true);
//     //         markup();
//     //         updateClasses();
//     //     });
//     //     slider.on("slideChanged", () => {
//     //         updateClasses();
//     //     });
//     //     slider.on("destroyed", () => {
//     //         markup(true);
//     //     });
//     // }

// }
// increase and decrease quantity
if (window.location.pathname == "/cart") {
    function decreaseQuantity(cartItem_id) {
        const url = window.location.origin + "/change-quantity";
        axios
            .patch(url, { type: "0", id: cartItem_id })
            .then((res) => (window.location = "/cart"))
            .catch((err) => (window.location = "/cart"));
    }
    window.decreaseQuantity = decreaseQuantity;

    function increaseQuantity(cartItem_id) {
        const url = window.location.origin + "/change-quantity";
        axios
            .patch(url, { type: "1", id: cartItem_id })
            .then((res) => (window.location = "/cart"))
            .catch((err) => (window.location = "/cart"));
    }
    window.increaseQuantity = increaseQuantity;
}
// products images slider
const productsImages = document.getElementsByClassName("swiper")[0];
if (productsImages) {
    const swiper = new Swiper(".swiper", {
        observer: true,
        observeParents: true,
        loop: true,
    });

    document
        .getElementsByClassName("swiper-button-next")[0]
        .addEventListener("click", () => {
            productsImages.swiper.slideNext();
        });

    document
        .getElementsByClassName("swiper-button-prev")[0]
        .addEventListener("click", () => {
            productsImages.swiper.slidePrev();
        });

    // disable add to cart when quantity is 0
    const addToCart = document.getElementById("addToCart");
    const quantity = document.getElementById("quantity");

    setInterval(() => {
        if (quantity.value == 0 || !quantity.value) addToCart.disabled = true;
        else addToCart.disabled = false;
    }, 200);
}

if (window.location.pathname == "/") {
    var slider = new KeenSlider("#my-keen-slider", { loop: true }, [
        // navigation,
    ]);
}
if (slider) {
    var timer = setInterval(() => {
        slider.next();
    }, 3000);

    slider.on("slideChanged", () => {
        clearInterval(timer);
        timer = setInterval(() => {
            slider.next();
        }, 3000);
    });
}

window.confirmDelete = confirmDelete;
window.deleteSource = deleteSource;
window.removePopup = removePopup;

if (document.querySelector("html").getAttribute("data-mode") == "dashboard") {
    const dashboardSidebar = document.getElementById("dashboard-sidebar");
    const dashboardContent = document.getElementById("dashboard-content");

    dashboardSidebar.classList.remove("opacity-0");
    dashboardContent.classList.remove("opacity-0");
}
function confirmDelete(url, name, redirect) {
    console.log(url);
    const popup = document.createElement("div");
    popup.id = "popup";
    popup.innerHTML = `
    <div class="card w-96 bg-neutral text-neutral-content fixed delete-confirm">
    <div class="card-body items-center text-center">
      <h2 class="card-title mb-3">delete confimation!</h2>
      <p>Are you sure you want to delete ${name}</p>
      <div class="card-actions justify-end my-3">
        <button onclick="deleteSource('${url}','${redirect}' )" class="btn btn-error">Delete</button>
        <button onclick="removePopup()" class="btn btn-ghost">Cancel</button>
      </div>
    </div>
    </div>
    <div id="overlay"></div>
    `;
    document.querySelector("body").appendChild(popup);
}

function deleteSource(url, redirect) {
    fetch(url, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((res) => res.text()) // or res.json()
        .then((res) => {
            console.log(redirect);
            window.location = redirect;
        });
}
function removePopup() {
    const popup = document.getElementById("popup");
    document.querySelector("body").removeChild(popup);
}
// categories

const selectCats = document.getElementById("select-categories");
const categories = document.getElementById("categories");
const categoriesList = document.getElementById("categories-list");

if (selectCats) {
    selectCats.addEventListener("change", (e) => {
        if (categoriesList.childNodes.length == 0) {
            categories.value = null;
        }
        // check if the category is added
        const cats = categories.value.split(",");
        let exist = cats.includes(e.target.value);
        if (exist) return;
        // add category to the list
        const cat = document.createElement("div");
        const times = document.createElement("i");
        const content = document.createElement("span");
        content.textContent = e.target.value;
        times.classList.add("fa", "fa-circle-xmark");
        cat.classList.add(
            "badge",
            "badge-info",
            "text-white",
            "mx-1",
            "text-md",
            "gap-2",
            "my-1"
        );
        times.addEventListener("click", () => {
            const cat_name = cat.childNodes.item(1).textContent;
            removeCategory(cat, cat_name);
        });

        cat.appendChild(times);
        cat.appendChild(content);

        categoriesList.appendChild(cat);
        if (!categories.value) {
            return (categories.value = e.target.value);
        }
        categories.value += "," + e.target.value;
    });
}
const removeCategory = (node, cat) => {
    // remove from categories value
    const cats = categories.value.split(",");
    const index = cats.indexOf(cat);

    cats.splice(index, 1);

    categories.value = cats.join(",");
    // remove from ui
    categoriesList.removeChild(node);
};

// images upload
const images = document.getElementById("images");
const all_images = document.getElementById("all_images");
const dataTransfer = new DataTransfer();

const filesCount = document.querySelector("#files_count span");
const progress = document.querySelector("#files_count progress");
if (images) {
    images.addEventListener("change", (e) => {
        const files = images.files;
        for (let i = 0; i < files.length; i++) {
            let file = files.item(i);
            dataTransfer.items.add(file);
        }
        filesCount.textContent = dataTransfer.files.length;
        progress.value = dataTransfer.files.length;
        all_images.files = dataTransfer.files;
    });
}

// toast messages
const toast = document.getElementById("toast");
if (toast) {
    const fade = () => {
        setTimeout(() => {
            toast.classList.add("fade");
        }, 3000);
        setTimeout(() => {
            document.querySelector("body").removeChild(toast);
        }, 4000);
    };

    fade();
}

// users dashboard
if (window.location.pathname == "/dashboard/users") {
    const toggleBlock = (id) => {
        axios
            .patch(`/dashboard/users/toggle-block/${id}`, {})
            .then((res) => (window.location = window.location));
    };

    window.toggleBlock = toggleBlock;
}
