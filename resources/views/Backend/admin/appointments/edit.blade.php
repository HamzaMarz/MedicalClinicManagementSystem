<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Appointment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 0;
    }

    .page-wrapper {
      padding: 30px;
    }

    .page-title {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #333;
    }

    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      margin-bottom: 20px;
      background: #fff;
      overflow: hidden;
    }

    .card-header {
      background-color: #00A8FF;
      color: #fff;
      font-weight: 600;
      padding: 12px 15px;
      font-size: 16px;
      border-bottom: 1px solid #ddd;
    }

    .card-body {
      padding: 20px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .col-sm-6 {
      flex: 1 1 calc(50% - 20px);
    }

    label {
      font-weight: 600;
      margin-bottom: 6px;
      display: block;
      color: #333;
    }

    .input-group {
      display: flex;
      align-items: center;
    }

    .input-group-text {
      background: #eee;
      padding: 8px 12px;
      border: 1px solid #ddd;
      border-right: none;
      border-radius: 5px 0 0 5px;
    }

    .form-control {
      flex: 1;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 0 5px 5px 0;
    }

    textarea.form-control {
      border-radius: 5px;
      min-height: 80px;
    }

    .submit-btn {
      background: #007BFF;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    .submit-btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<div class="page-wrapper">
  <h4 class="page-title">Edit Appointment</h4>

  <form method="POST" action="#">
    <!-- Appointment Details -->
    <div class="card">
      <div class="card-header">Appointment Details</div>
      <div class="card-body">
        <div class="row">

          <!-- Patient -->
          <div class="col-sm-6">
            <label>Patient Name <span style="color:red">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
              <select class="form-control" name="patient_id" required>
                <option value="" disabled hidden>Select Patient</option>
                <option value="1" selected>John Doe</option>
                <option value="2">Jane Smith</option>
              </select>
            </div>
          </div>

          <!-- Department -->
          <div class="col-sm-6">
            <label>Department <span style="color:red">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
              <select class="form-control" name="department_id" required>
                <option value="" disabled hidden>Select Department</option>
                <option value="1" selected>Cardiology</option>
                <option value="2">Neurology</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Doctor <span style="color:red">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user-md"></i></span>
              <select class="form-control" name="doctor_id" required>
                <option value="" disabled hidden>Select Doctor</option>
                <option value="1" selected>Dr. Smith</option>
                <option value="2">Dr. Brown</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Appointment Time <span style="color:red">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-clock"></i></span>
              <select class="form-control" name="appointment_time" required>
                <option value="" disabled hidden>Select Time</option>
                <option value="09:00" selected>09:00 AM</option>
                <option value="10:00">10:00 AM</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Appointment Day <span style="color:red">*</span></label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              <select class="form-control" name="appointment_day" required>
                <option value="" disabled hidden>Select Day</option>
                <option value="Monday" selected>Monday</option>
                <option value="Tuesday">Tuesday</option>
              </select>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Notes -->
    <div class="card">
      <div class="card-header">Notes</div>
      <div class="card-body">
        <div class="form-group">
          <label>Notes</label>
          <textarea class="form-control" name="notes">Follow-up for blood test results.</textarea>
        </div>
      </div>
    </div>

    <div class="text-center" style="margin-top:20px;">
      <button type="submit" class="submit-btn">Edit Appointment</button>
    </div>
  </form>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>