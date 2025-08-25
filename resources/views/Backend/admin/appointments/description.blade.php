<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Appointment Description</title>
  <style>
    .appointment-container {
      margin-top: 40px;
      font-family: Arial, sans-serif;
    }

    .card-appointment {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      padding: 30px;
      transition: 0.3s;
    }

    .card-appointment:hover {
      box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }

    .appointment-header {
      font-size: 24px;
      font-weight: 700;
      color: #007BFF;
      margin-bottom: 25px;
      border-bottom: 2px solid #f0f0f0;
      padding-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .appointment-header i {
      color: #007BFF;
    }

    .appointment-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
    }

    .info-box {
      background: #f9f9f9;
      border-radius: 12px;
      padding: 18px 22px;
      border: 1px solid #e6e6e6;
    }

    .info-box .label {
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      gap: 6px;
      color: #007BFF;   /* 🔵 العناوين باللون الأزرق */
    }

    .info-box .label i {
      color: #007BFF;   /* 🔵 الأيقونات باللون الأزرق */
    }

    .info-box .value {
      font-size: 16px;
      font-weight: 500;
      color: #222;
    }

    .status-badge {
      padding: 6px 16px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: bold;
      display: inline-block;
    }
    .Scheduled { background-color: #03A9F4; color: white; }
    .Completed { background-color: #28C76F; color: white; }
    .Cancelled { background-color: #F44336; color: white; }

    .notes {
      margin-top: 25px;
      background: #f9f9f9;
      border: 1px solid #e6e6e6;
      border-radius: 10px;
      padding: 20px;
    }

    .notes h5 {
      font-size: 16px;
      font-weight: bold;
      color: #007BFF;   /* 🔵 عنوان الملاحظات أزرق */
      margin-bottom: 10px;
    }

    .back-btn {
      margin-top: 25px;
      background: #007BFF;
      border-radius: 50px;
      padding: 10px 28px;
      font-weight: 600;
      color: #fff;
      text-decoration: none;
      transition: 0.3s;
      display: inline-block;
    }

    .back-btn:hover {
      background: #0056b3;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="page-wrapper appointment-container">
    <div class="content">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card-appointment">

            <div class="appointment-header">
              <i class="fas fa-calendar-alt"></i>
              Appointment Details
            </div>

            <div class="appointment-details">

              <div class="info-box">
                <div class="label"><i class="fas fa-user-injured"></i> Patient</div>
                <div class="value">John Doe</div>
              </div>

              <div class="info-box">
                <div class="label"><i class="fas fa-stethoscope"></i> Department</div>
                <div class="value">Cardiology</div>
              </div>

              <div class="info-box">
                <div class="label"><i class="fas fa-user-md"></i> Doctor</div>
                <div class="value">Dr. Smith</div>
              </div>

              <div class="info-box">
                <div class="label"><i class="fas fa-calendar-day"></i> Date</div>
                <div class="value">2025-08-24</div>
              </div>

              <div class="info-box">
                <div class="label"><i class="fas fa-clock"></i> Time</div>
                <div class="value">10:30 AM</div>
              </div>

              <div class="info-box">
                <div class="label"><i class="fas fa-flag-checkered"></i> Status</div>
                <div class="value">
                  <span class="status-badge Scheduled">Scheduled</span>
                </div>
              </div>

            </div>

            <div class="notes">
              <h5><i class="fas fa-sticky-note"></i> Notes</h5>
              <p class="mb-0 text-muted">
                Follow-up appointment for blood test results.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-3 d-flex justify-content-end" style="margin-top: 15px; margin-right:110px;">
        <a href="appointments.html" class="back-btn">Back</a>
      </div>
    </div>
  </div>
</body>
</html>