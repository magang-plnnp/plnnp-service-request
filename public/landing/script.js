 // Navbar scroll effect
      window.addEventListener("scroll", function () {
        const navbar = document.getElementById("navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      // Smooth scrolling for navigation links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      function showForm(type) {
        // Hide all forms
        document.querySelectorAll(".form-section").forEach((section) => {
          section.classList.remove("active");
        });

        // Remove active class from all buttons
        document.querySelectorAll(".menu-btn").forEach((btn) => {
          btn.classList.remove("active");
        });

        // Show selected form and activate button
        if (type === "food") {
          document.getElementById("foodForm").classList.add("active");
          document.getElementById("foodBtn").classList.add("active");
        } else {
          document.getElementById("vehicleForm").classList.add("active");
          document.getElementById("vehicleBtn").classList.add("active");
        }
      }

      function submitFoodForm(event) {
        event.preventDefault();

        // Simulate form submission
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData);

        console.log("Food Request Data:", data);

        // Show success message
        document.getElementById("foodSuccess").style.display = "block";

        // Reset form
        event.target.reset();

        // Scroll to top of form
        document
          .getElementById("foodForm")
          .scrollIntoView({ behavior: "smooth" });

        // Hide success message after 8 seconds
        setTimeout(() => {
          document.getElementById("foodSuccess").style.display = "none";
        }, 8000);
      }

      function submitVehicleForm(event) {
        event.preventDefault();

        // Simulate form submission
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData);

        console.log("Vehicle Request Data:", data);

        // Show success message
        document.getElementById("vehicleSuccess").style.display = "block";

        // Reset form
        event.target.reset();

        // Scroll to top of form
        document
          .getElementById("vehicleForm")
          .scrollIntoView({ behavior: "smooth" });

        // Hide success message after 8 seconds
        setTimeout(() => {
          document.getElementById("vehicleSuccess").style.display = "none";
        }, 8000);
      }

      // Set minimum date to today
      document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("eventDate").min = today;
        document.getElementById("startDate").min = today;
        document.getElementById("endDate").min = today;

        // Update end date minimum when start date changes
        document
          .getElementById("startDate")
          .addEventListener("change", function () {
            document.getElementById("endDate").min = this.value;
          });
      });

      // Format number inputs
      document.getElementById("budget").addEventListener("input", function () {
        let value = this.value.replace(/\D/g, "");
        if (value) {
          this.value = parseInt(value).toLocaleString("id-ID");
        }
      });