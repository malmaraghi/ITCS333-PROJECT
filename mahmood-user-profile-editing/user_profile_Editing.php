<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pico.min.css">
    <link rel="stylesheet" href="Profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Profile Editing</title>
</head>
<body>
    <div class="profile-container">
        <header class="profile-header">
            <div class="profil-image">
                <!-- Dynamically set the image source -->
                <img id="profilePreview" 
                     src="<?php echo htmlspecialchars($profileImage ??''); ?>" 
                     alt="Profile Image">
                <br>
                <input type="file" id="imageUpload" name="photo" accept="image/*" style="display: none;">
                <br>
                <button type="button" class="edit-photo-btn" onclick="triggerImageUpload()">Change Photo</button>
            </div>
            <div class="profile-details">
                <form id="updateForm" class="profile-info-form" method="POST" action="update.php" enctype="multipart/form-data">
                    <label for="name">Username: </label>
                    <input type="text" id="name" name="username" placeholder="Enter the new username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    <span class="error"><?php echo $usernameErr ?? ''; ?></span>
                    <br>

                    <label for="email">Contact: </label>
                    <input type="email" id="Contact" name="Contact" placeholder="Enter your personal email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    <span class="error"><?php echo $emailErr ?? ''; ?></span>
                    <br>

                    <label for="phone">Phone: </label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                    <span class="error"><?php echo $phoneErr ?? ''; ?></span>
                    <br>

                    <label for="comments">Comment: </label>
                    <textarea id="comments" name="comments" placeholder="Enter your suggestions or comments"><?php echo htmlspecialchars($bio ?? ''); ?></textarea>
                    <br>

                    <input type="hidden" id="uploadedFilePath" name="photo">

                    <button type="button" class="save-btn" onclick="submitForm()">Save</button>
                    <button type="reset" class="cancel-btn">Cancel</button>
                </form>
            </div>
        </header>

        <div class="container-2">
            <div class="Reference"><h3>UOB Reference</h3></div>
            <div class="UOB-References">
                <ul>
                    <li><a href="http://www.uob.edu.bh/" target="_blank">Official Website</a></li>
                    <li><a href="https://sis.uob.edu.bh/sign-in" target="_blank">SIS</a></li>
                    <li><a href="https://blackboard.uob.edu.bh/" target="_blank">Blackboard</a></li>
                </ul>
            </div>
        </div>
        <footer class="footer">
            <div class="social-media-account">
                <h3>Social media accounts</h3>
            </div>
            <div class="account">
                <div class="twitter"><a href="https://x.com/uobedubh?lang=ar" target="_blank"><i class="fa-brands fa-twitter"></i><h6>Twitter</h6></a></div>
                <div class="instagram"><a href="https://www.instagram.com/uobedubh/?hl=ar" target="_blank"><i class="fa-brands fa-instagram"></i><h6>Instagram</h6></a></div>
                <div class="threads"><a href="https://www.threads.net/@uobedubh?hl=ar" target="_blank"><i class="fa-brands fa-threads"></i><h6>Threads</h6></a></div>
                <div class="linkedin"><a href="https://www.linkedin.com/company/bahrain-university/" target="_blank"><i class="fa-brands fa-linkedin-in"></i><h6>LinkedIn</h6></a></div>
            </div>
        </footer>
    </div>

    <script>
        function triggerImageUpload() {
            document.getElementById('imageUpload').click();
        }

        document.getElementById('imageUpload').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('photo', file);

                fetch('update.php?action=uploadImage', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profilePreview').src = data.filePath;
                        document.getElementById('uploadedFilePath').value = data.filePath;
                        alert('Image uploaded successfully!');
                    } else {
                        alert(data.message || 'Error uploading image.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while uploading the image.');
                });
            }
        });

        function submitForm() {
            const form = document.getElementById('updateForm');
            const formData = new FormData(form);

            fetch('update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the profile.');
            });
        }
    </script>
</body>
</html>
