<!-- About Section -->
<div id="about" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-6 py-5">
        <h2 class="h2 mb-4">About Us</h2>
        <p><strong>The Multimodal Centralized Imaging Data Repository (MUCIDAR)</strong> is a secure platform designed
          for the centralized storage and management of stroke-related medical images, including CT,
          MRI, ultrasound, and PET scans. It enhances collaboration among healthcare professionals
          and researchers, enabling comprehensive data analysis and promoting innovation in stroke
          treatment and research. By providing standardized, accessible imaging data, MCIDR ultimately
          aims to improve patient outcomes and advance the understanding of stroke care.</p>
      </div>
      <div class="col-md-6">
        <img src="assets/images/about.jpg" alt="About Image" class="img-fluid">
      </div>

    </div>
  </div>
</div>

<!-- Modality Section -->
<div id="modality" class="section bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4">Stroke Modalities</h2>
    <div class="row mt-4">
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card bg-dark text-white shadow">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="CT Scan">
          <div class="card-body">
            <h5 class="card-title">CT Scan</h5>
            <p class="card-text">CT scans provide rapid imaging for acute stroke assessment, allowing for quick diagnosis and treatment decisions.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card bg-dark text-white shadow">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="MRI Scan">
          <div class="card-body">
            <h5 class="card-title">MRI Scan</h5>
            <p class="card-text">MRI scans offer detailed structural and functional imaging, essential for planning treatment strategies.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card bg-dark text-white shadow">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="Ultrasound">
          <div class="card-body">
            <h5 class="card-title">Ultrasound</h5>
            <p class="card-text">Ultrasound is a non-invasive technique that evaluates blood flow and vascular conditions associated with strokes.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card bg-dark text-white shadow">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="PET Scan">
          <div class="card-body">
            <h5 class="card-title">PET Scan</h5>
            <p class="card-text">PET scans help assess brain activity and metabolism, aiding in the understanding of stroke impact.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Repository Section -->
<div id="repository" class="section repository">
  <div class="container">
    <h2 class="text-center mb-4">Repository of Stroke Imaging</h2>
    <div class="row mt-4">
      <!-- Example Post 1 -->
      <div class="col-md-4 mb-4">
        <div class="card bg-dark text-white">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="Stroke Imaging 1">
          <div class="card-body text-center">
            <h5 class="card-title">Stroke Imaging Post 1</h5>
            <p class="card-text">Uploaded on: <strong>October 20, 2024</strong></p>
            <p class="card-text">Author: <strong>Dr. Jane Doe</strong></p>
            <div class="mb-3">
              <span class="badge bg-info">CT Scan</span>
              <span class="badge bg-info">MRI</span>
            </div>
            <a href="#" class="btn btn-purple">View Data</a>
          </div>
        </div>
      </div>

      <!-- Example Post 2 -->
      <div class="col-md-4 mb-4">
        <div class="card bg-dark text-white">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="Stroke Imaging 2">
          <div class="card-body text-center">
            <h5 class="card-title">Stroke Imaging Post 2</h5>
            <p class="card-text">Uploaded on: <strong>October 18, 2024</strong></p>
            <p class="card-text">Author: <strong>Dr. John Smith</strong></p>
            <div class="mb-3">
              <span class="badge bg-info">Ultrasound</span>
              <span class="badge bg-info">Angiography</span>
            </div>
            <a href="#" class="btn btn-purple">View Data</a>
          </div>
        </div>
      </div>

      <!-- Example Post 3 -->
      <div class="col-md-4 mb-4">
        <div class="card bg-dark text-white">
          <img src="assets/images/sample.jpeg" class="card-img-top" alt="Stroke Imaging 3">
          <div class="card-body text-center">
            <h5 class="card-title">Stroke Imaging Post 3</h5>
            <p class="card-text">Uploaded on: <strong>October 15, 2024</strong></p>
            <p class="card-text">Author: <strong>Dr. Alice Johnson</strong></p>
            <div class="mb-3">
              <span class="badge bg-info">Functional MRI</span>
              <span class="badge bg-info">PET Scan</span>
            </div>
            <a href="#" class="btn btn-purple">View Data</a>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <a href="#" class="btn btn-3d-purple btn-lg">View More</a>
    </div>
  </div>
</div>

<!-- Contact Section -->
<div id="contact" class="section bg-light py-5">
  <div class="container">
    <h2 class="text-center mb-4">Contact Us</h2>
    <div class="row mt-4">
      <div class="col-md-6">
        <form id="contactForm" action="/contactForm" method="POST">
          <!-- Home View -->
          <?php if (!empty($flash_message)): ?>
            <script>
              document.addEventListener("DOMContentLoaded", function() {
                alert("<?php echo htmlspecialchars($flash_message); ?>");
              });
            </script>
          <?php endif; ?>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-dark">Send Message</button>
        </form>
      </div>
      <div class="col-md-6">
        <h5>Our Address</h5>
        <p>Data Science and Medical Image Analysis Training in Nigeria (DATICAN)</p>
        <p>Lagos State University</p>
        <p>Lasu Main Road,</p>
        <p>Ojo, Lagos.</p>
        <p>Email: <a href="mailto:manager.datican@gmail.com">manager.datican@gmail.com</a></p>
        <p>Phone: (123) 456-7890</p>
      </div>
    </div>
  </div>
</div>

<!-- Footer Section -->
<footer class="bg-purple text-white py-4">
  <div class="container">
    <div class="row mt-4">
      <div class="col-md-4">
        <h5>About Us</h5>
        <p>Data Science and Medical Image Analysis Training in Nigeria (DATICAN) aims to advance the field of medical imaging and data analysis through research, education, and community engagement.</p>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#about" class="text-white">About</a></li>
          <li><a href="#features" class="text-white">Features</a></li>
          <li><a href="#collections" class="text-white">Repository</a></li>
          <li><a href="#contact" class="text-white">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <p>Lagos State University, Lasu Main Road, Ojo, Lagos.</p>
        <p>Email: <a href="mailto:manager.datican@gmail.com" class="text-white">manager.datican@gmail.com</a></p>
        <p>Phone: <a href="tel:+1234567890" class="text-white">(123) 456-7890</a></p>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col text-center">
        <h5>Follow Us</h5>
        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col text-center">
        <p class="mb-0">© 2024 MUCIDAR. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- Back to Top Button -->
<a href="#" class="back-to-top" id="backToTop">
  <i class="fas fa-arrow-up"></i>
</a>