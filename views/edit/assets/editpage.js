$(document).ready(() => {
  $("#myModal").modal({
    keyboard: true,
    show: false,
  });

  $("#photo").change((event) => {
    $("#discPhoto").prop("src", URL.createObjectURL(event.target.files[0]));
  });
});

const handleSubmit = (status) => {
  const form = $("#contentForm");

  const title = form.find('input[name="headline"]').val() || null;
  const content = form.find('textarea[name="content"]').val() || null;
  const photo =
    form.find('input[name="photo"]').val() || status === "edit" ? true : null;

  const isFilled = () => {
    if (title && content && photo) return true;
    else return false;
  };

  if (isFilled()) {
    $("#contentForm").submit();
  } else {
    $("#errModal").modal();
  }
};

const handleCancel = (event) => {
  $("#warnModal").modal();
};
