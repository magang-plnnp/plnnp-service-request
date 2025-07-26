

function showDetailModal(title, data) {
        const modal = document.getElementById("detailModal");
        const content = document.getElementById("detailContent");

        // Ubah object menjadi daftar isi
        const html = Object.entries(data)
          .map(
            ([key, value]) =>
              `<div><strong>${toTitle(key)}:</strong> ${value}</div>`
          )
          .join("");

        content.innerHTML =
          `<h3 style="margin-bottom:10px">${title}</h3>` + html;
        modal.classList.add("active");
        document.body.style.overflow = "hidden";
      }

      function closeDetailModal() {
        document.getElementById("detailModal").classList.remove("active");
        document.body.style.overflow = "auto";
      }

      let sidebarCollapsed = false;

      // Sample data

      // Toggle Sidebar
      function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");

        // Hanya izinkan toggle sidebar di mobile (<= 1024px)
        if (window.innerWidth <= 1024) {
          sidebar.classList.toggle("active");
        }
      }

      // Show Page
      function showPage(pageName) {
        // Hide all pages
        document.querySelectorAll(".page-content").forEach((page) => {
          page.classList.remove("active");
        });

        // Remove active class from all menu items
        document.querySelectorAll(".menu-item").forEach((item) => {
          item.classList.remove("active");
        });

        // Show selected page
        document.getElementById(pageName + "Page").classList.add("active");

        // Add active class to clicked menu item
        event.target.closest(".menu-item").classList.add("active");

        // Update page title
        const titles = {
          dashboard: "Dashboard",
          peminjaman: "Peminjaman Kendaraan",
          pengadaan: "Pengadaan Makanan",
        };
        document.getElementById("pageTitle").textContent =
          titles[pageName] || "Dashboard";
      }

      document.addEventListener("click", function (e) {
        const sidebar = document.getElementById("sidebar");
        const isMobile = window.innerWidth <= 1024;

        if (isMobile && sidebar.classList.contains("active")) {
          if (!sidebar.contains(e.target) && !e.target.closest(".toggle-btn")) {
            sidebar.classList.remove("active");
          }
        }
      });

      // Modal Functions
      function openModal(modalId) {
        document.getElementById(modalId).classList.add("active");
        document.body.style.overflow = "hidden";

        // Reset form
        if (modalId === "peminjamanModal") {
          document.getElementById("peminjamanForm").reset();
          currentEditId = null;
          currentEditType = "peminjaman";
        } else if (modalId === "pengadaanModal") {
          document.getElementById("pengadaanForm").reset();
          currentEditId = null;
          currentEditType = "pengadaan";
        }
      }

      function closeModal(modalId) {
        document.getElementById(modalId).classList.remove("active");
        document.body.style.overflow = "auto";
        currentEditId = null;
        currentEditType = null;
      }

      // Close modal when clicking outside
      document.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal-overlay")) {
          const modalId = e.target.id;
          closeModal(modalId);
        }
      });

      // Responsive sidebar for mobile
      function handleResize() {
        if (window.innerWidth <= 1024) {
          document.getElementById("sidebar").classList.remove("active");
          document.getElementById("mainContent").classList.remove("expanded");
        }
      }

      window.addEventListener("resize", handleResize);

      // Mobile sidebar toggle
      if (window.innerWidth <= 1024) {
        function toggleSidebar() {
          const sidebar = document.getElementById("sidebar");
          sidebar.classList.toggle("active");
        }
      }