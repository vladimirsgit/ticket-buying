<div class="container mt-5 mb-5">
    <?php if(isset($_SESSION['empty_fields'])){ ?>
    <p style="color: red">Please make sure none of the fields are empty!</p>
    <?php } unset($_SESSION['empty_fields'])?>
    <?php if(isset($_SESSION['invalid_data'])){ ?>
        <p style="color: red">Invalid data!</p>
    <?php } unset($_SESSION['invalid_data'])?>
    <?php if(isset($_SESSION['add_event_OK'])){ ?>
        <p style="color: #30bde7">Event added!</p>
    <?php } unset($_SESSION['add_event_OK'])?>
    <h2 class="text-center">Add Event Form</h2>
    <form id="add_event_form" action="/tickets/adminDashboard" method="post">
        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input type="text" class="form-control" name="event_name" placeholder="Enter event name" >
        </div>
        <div class="form-group">
            <label for="eventType">Event Type</label>
            <select class="form-control" name="event_type">
                <option>movie</option>
                <option>concert</option>
                <option>theater</option>
            </select>
        </div>
        <div class="form-group">
            <label for="eventDate">Date</label>
            <input type="date" class="form-control" name="event_date">
        </div>
        <div class="form-group">
            <label for="eventTime">Time (24 hrs)</label>
            <input type="time" class="form-control" name="event_time" >
        </div>
        <div class="form-group">
            <label for="eventLocation">Location</label>
            <input type="text" class="form-control" name="event_location" placeholder="Enter location" >
        </div>
        <div class="form-group">
            <label for="availableTickets">Available Tickets</label>
            <input type="number" class="form-control" name="total_tickets" placeholder="Enter number of available tickets" >
        </div>
        <div class="form-group">
            <label for="eventPrice">Price</label>
            <input type="number" class="form-control" name="ticket_price" placeholder="Enter price"  step=".01">
        </div>
        <div class="form-group">
            <label for="eventDescription">Description</label>
            <textarea class="form-control" name="event_description" rows="3" ></textarea>
        </div>
        <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        <button name="add_event" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>