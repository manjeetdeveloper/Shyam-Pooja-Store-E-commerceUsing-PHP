<div class="popup-overlay">
    <div class="popup-form">
        <button type="button" class="close-btn">&times;</button>
        <h2>Join Us</h2>
        <form action="join_form.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="user_list">Upload Your List</label>
                <div class="file-upload">
                    <input type="file" id="user_list" name="user_list" accept=".pdf,.doc,.docx,.txt">
                    <span>Choose File</span>
                </div>
                <small>Accepted formats: PDF, DOC, DOCX, TXT</small>
            </div>
            
            <button type="submit" class="submit-btn">Submit Form</button>
        </form>
    </div>
</div>