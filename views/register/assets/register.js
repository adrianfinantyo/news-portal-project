$(document).ready(() => {
  $("#photoPict").change((event) => {
    $("#tempPict").prop("src", URL.createObjectURL(event.target.files[0]));
  });
});
