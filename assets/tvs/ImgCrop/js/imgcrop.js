window.addEventListener("DOMContentLoaded", function () {
    const croppersBtn = document.querySelectorAll(".cropper");
    croppersBtn.forEach((el) => {
        let cropper;
        let img = el.querySelector(".img-crop");
        let input = el.querySelector(".cropper__input");
        const aspectRatio = input.dataset.aspectratio ?? "free";
        const format = input.dataset.format ?? "free";
        const bgcolor = input.dataset.bgcolor ?? "#000";
        input.addEventListener("change", () => {
            img.src = "/" + input.value;
            if (cropper) {
                cropper.replace("/" + input.value);
            }
        });
        el.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (e.target.closest(".imgcrop-cropper")) {
                // img = el.querySelector(".img-crop");
                const ratioArr = aspectRatio.split("/");

                cropper = new Cropper(img, {
                    aspectRatio: ratioArr[0] / ratioArr[1],
                    autoCropArea: 1,
                    zoom(event) {
                        const { detail } = event;

                        if (detail.originalEvent) {
                            event.preventDefault();
                            cropper.zoomTo(detail.ratio);
                        }
                    },
                });
            }
            if (e.target.closest(".imgcrop-cancel") && cropper) {
                cropper.destroy();
                img.src = "/" + input.value;
            }
            if (e.target.closest(".imgcrop-save") && cropper) {
                let formData = new FormData();
                let canvas = cropper.getCroppedCanvas({
                    fillColor: bgcolor,
                });
                canvas.toBlob(
                    function (blob) {
                        formData.append("file", blob);
                        formData.append(
                            "path",
                            input.value.replace("_crop", "")
                        );
                        fetch("/assets/tvs/ImgCrop/ajax.php", {
                            method: "POST",
                            body: formData,
                            headers: {
                                Accept: "application/json", // expected data sent back
                            },
                        })
                            .then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                input.value = data;
                                input.dispatchEvent(new Event("change"));
                            });
                    },
                    format,
                    1
                );
            }
        });
    });
});
