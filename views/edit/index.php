<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Portal - Edit</title>
    <link rel="News Portal Icon" href="../../assets/logo.ico" type="image/x-icon" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <!-- AOS  -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <!-- External CSS -->
    <link href="./assets/editpage.css" rel="stylesheet" />
    <!-- External JS -->
    <script src="./assets/editpage.js"></script>
</head>

<body>
    <?php
    require_once "../../controller/process.php";

    if(!isset($_SESSION["userEmail"]) && !isset($_SESSION["userName"])){
        header("location: ../../");
    }

    if(isset($_GET["mode"]) && $_GET["mode"] === "edit"){
      echo "
      <script>
          $(document).ready(() => {
              $('#headTitle').html('Edit Post');
              $('#save').html('Update')
          })
      </script>
      ";
      handleEditPost();
    } else  {
      handleCreatePost();
    }
  ?>
    <!-- MODALS -->
    <div id="errModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 3rem;">Error</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 1.8rem;">You must fill all the input!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div id="warnModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 3rem;">Warning</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 1.8rem;">Are you sure you want to leave? All data that has been filled in will
                        not be saved.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger"
                        onclick="window.location.href = '../home/'">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <?php
      if(isset($_SESSION["userEmail"]) && isset($_SESSION["userName"])){
        echo "
          <script>
            $(document).ready(() => {
              $('.login').hide();
              $('.logout').show();
            });
          </script>
        ";
      } else {
        echo "
        <script>
          $(document).ready(() => {
            $('.login').show();
            $('.logout').hide();
          });
        </script>
      ";
      }
    ?>
    <nav>
        <div class="navbar-header">
            <div class="navbar-brand">
                <img src="../../assets/logoblack-text.png" alt="News Portal" class="logo"
                    onclick="window.location.href = '../home/'" />
            </div>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <a href="../register/" class="login">
                <li class="active" id="signup">Sign Up</li>
            </a>
            <a href="../login/" class="login">
                <li id="login">Login</li>
            </a>
            <a href="../logout/" class="logout">
                <li id="login">Logout</li>
            </a>
        </ul>
    </nav>

    <!-- Content -->
    <form action="" method="POST" enctype="multipart/form-data" id="contentForm">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <h1 id="headTitle">Create Post</h1>
                        <input name="id" placeholder="id" hidden />
                        <input name="headline" placeholder="Title" />
                        <textarea name="content" id="editor" placeholder="Write your story here!">
              </textarea>
                    </div>
                </div>
                <span class="col-sm-1"></span>
                <div class="col-sm-3">
                    <div class="row" id="btn-container">
                        <button id="cancel" type="button" onclick="handleCancel(event)">Cancel</button>
                        <button id="save" type="button" onclick="handleSubmit(event)">Post</button>
                    </div>
                    <div class="row">
                        <h3>Category</h3>
                        <select name="kategori" id="kategori">
                            <option value="uncategorized" hidden>Uncategorized</option>
                            <option value="automotive">Automotive</option>
                            <option value="education">Education</option>
                            <option value="entertaintment">Entertaintment</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                    <div class="row">
                        <h3>Picture</h3>
                        <img id="discPhoto" src="https://i.stack.imgur.com/y9DpT.jpg" alt="Photo Attachment" />
                        <label for="photo">Upload Picture</label>
                        <input id="photo" type="file" accept="image/*" name="photo" />
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
    ClassicEditor.create(document.querySelector("#editor"))
        .then((editor) => {
            // console.log(editor);
        })
        .catch((error) => {
            // console.error(error);
        });
    </script>
</body>

</html>