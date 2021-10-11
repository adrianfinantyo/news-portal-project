const confirmDelete = (id) => {
  const input = document.getElementById("postID");
  input.setAttribute("value", id);
  $("#warnModal").modal();
};

const alertDone = (id) => {
  $("#succModal").modal();
};
