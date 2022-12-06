let hamburger = document.querySelector(".hamburger");
let navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    if (hamburger.classList.contains("active") && document.getElementById("id").value != "") {
        let inputs = document.getElementsByClassName("nav-link");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
        document.getElementById("checkbox").checked = false;
        document.getElementById("btnUpdate").value = "";
        document.getElementById("btnContainer").innerHTML = ' <button type="submit" name="save" class="btn btn-primary">save</button>';
        document.getElementById("id").remove();
    }

    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
    document.getElementsByTagName('body')[0].classList.toggle('stop-scrolling');
})