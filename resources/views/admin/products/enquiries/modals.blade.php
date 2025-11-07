<!-- admin/enquiries/modals.blade.php -->
<div id="replyModal" class="custom-modal-overlay" style="display: none;">
    <div class="custom-modal">
        <h3>Reply to Enquiry</h3>
        <form id="replyForm">
            <textarea id="replyMessage" rows="4" placeholder="Write your reply..."></textarea>
            <div class="modal-actions">
                <button type="button" class="btn cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn confirm">Send Reply</button>
            </div>
        </form>
    </div>
</div>