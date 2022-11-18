const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-button");

// show sidebar
menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

// close sidebar
closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

// change theme
const themeToggler = document.getElementById("theme-toggler");

// themeToggler.addEventListener('click', () => {
//     document.body.classList.toggle('dark-theme-variables');

//     let sun_icon = document.getElementById("sun");
//     let moon_icon = document.getElementById("moon");
//     if(moon_icon.style.color === "coral"){
//         sun_icon.style.color = "coral";
//         moon_icon.style.color = "#000";
//     } else {
//         sun_icon.style.color = "#fff";
//         moon_icon.style.color = "coral";
//     }
// });

//TO MAINTAIN THE THEME (DARK MODE, LIGHT MODE)
//Check localStorage
darkOn = localStorage.getItem("dark") == "true" ? true : false;
setTheme();

function setTheme(){
    let sun_icon = document.getElementById("sun");
    let moon_icon = document.getElementById("moon");
    //Save to localStorage
    localStorage.setItem("dark", darkOn ? "true" : "false");
    if(darkOn){
        document.body.setAttribute("theme", "dark");
        // togButton.innerHTML = "Turn off dark mode.";
        // document.body.classList.toggle('dark-theme-variables');
        sun_icon.style.color = "#fff";
        moon_icon.style.color = "coral";
    }
    else{
        document.body.setAttribute("theme", "light");
        // togButton.innerHTML = "Turn on dark mode.";
        // document.body.classList.toggle('dark-theme-variables');
        sun_icon.style.color = "coral";
        moon_icon.style.color = "#000";
    }

    // let sun_icon = document.getElementById("sun");
    // let moon_icon = document.getElementById("moon");
    // if(moon_icon.style.color === "coral"){
    //     sun_icon.style.color = "coral";
    //     moon_icon.style.color = "#000";
    // } else {
    //     sun_icon.style.color = "#fff";
    //     moon_icon.style.color = "coral";
    // }
}

var darkOn = false;
function toggle(){
    darkOn = !darkOn;
    setTheme();
}

themeToggler.addEventListener("click", toggle);

// // fill recently added in table
// const statusClass = status => {
//     if(status === 'Employed') return 'success';
//     else if(status === 'On leave') return 'warning';
//     else if(status === 'Resigned' || status === 'Fired' || status === 'Retired') return 'danger';
//     else return null;
// };

//set password visibility
let password = document.querySelectorAll('.showpass');
let toggler = document.querySelectorAll('.toggler');

for(let i = 0; i < password.length; i++) { 
    toggler[i].addEventListener('click', () => {
        if (password[i].type == 'password') {
            password[i].setAttribute('type', 'text');
            toggler[i].textContent = "visibility_off";
        } else {
            password[i].setAttribute('type', 'password');
            toggler[i].textContent = "visibility";
        }
    });
}

document.querySelector('.messageBox').scrollTop = document.querySelector('.messageBox').scrollHeight;