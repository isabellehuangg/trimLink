form = document.querySelector(".wrap form");
longURL = form.querySelector("input");
trimButton = form.querySelector("button");
popupBlur = document.querySelector(".blur");
popupBox = document.querySelector(".popup");

// Popup box elements
trimURL = popupBox.querySelector(".trim-link");
saveButton = popupBox.querySelector("button");
copyButton = popupBox.querySelector(".copy-icon");
form2 = popupBox.querySelector("form");

form.onsubmit = (e) => {
    e.preventDefault();
}

trimButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/url-control.php", true);
    xhr.onload = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data = xhr.response;
            if (data.length <= 5) {
                popupBox.classList.add("show");
                popupBlur.style.display = "block";

                let baseURL = "localhost/trimLink/";
                trimURL.value = baseURL + data;

                // Issue with copy and save
                copyButton.onclick = () => {
                    trimURL.select();
                    document.execCommand("copy");
                }

                form2.onsubmit = (e) => {
                    e.preventDefault();
                }

                saveButton.onclick = () => {
                    location.reload();
                }
            } else {
                alert(data);
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}