 <!-- latest jquery-->
 <script src="<?= base_url() ?>cuba/assets/js/jquery-3.5.1.min.js"></script>
 <!-- Bootstrap js-->
 <script src="<?= base_url() ?>cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
 <!-- feather icon js-->
 <script src="<?= base_url() ?>cuba/assets/js/icons/feather-icon/feather.min.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
 <!-- scrollbar js-->
 <script src="<?= base_url() ?>cuba/assets/js/scrollbar/simplebar.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/scrollbar/custom.js"></script>
 <!-- Sidebar jquery-->
 <script src="<?= base_url() ?>cuba/assets/js/config.js"></script>

 <!-- Plugins JS start-->

 <script src="<?= base_url() ?>cuba/assets/js/sidebar-menu.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/slick/slick.min.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/slick/slick.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/header-slick.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/chart/apex-chart/apex-chart.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/animation/wow/wow.min.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/prism/prism.min.js"></script>
 <script src="<?= base_url() ?>assets/js/sweetalert/sweetalert2.min.js"></script>
 <!-- Datatable -->
 <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

 <!-- include script & Plugins -->
 <script src="<?= base_url() ?>cuba/assets/js/notify/bootstrap-notify.min.js"></script>
 <?= $this->renderSection('script') ?>

 <!-- Theme js-->
 <script src="<?= base_url() ?>cuba/assets/js/script.js"></script>
 <script src="<?= base_url() ?>cuba/assets/js/theme-customizer/customizer.js"></script>
 <!-- login js-->
 <!-- Plugin used-->
 <!-- FCM js-->
 <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>
 <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js"></script>
 <script>
     const firebaseConfig = {
         apiKey: "AIzaSyBAuc16rcETlNa2NeSoyZyKKkCQuvV9fcE",
         authDomain: "nse-alazca.firebaseapp.com",
         projectId: "nse-alazca",
         storageBucket: "nse-alazca.appspot.com",
         messagingSenderId: "248635132480",
         appId: "1:248635132480:web:5d027c7cab14ff90a92da5",
         measurementId: "G-P47TXPNNF0"
     };
     firebase.initializeApp(firebaseConfig);

     const fcm = firebase.messaging()
     fcm.getToken({
         vapidKey: 'BCeIEXunOsxZ00hgGG3M87554oFEG4fP3HBg3ihtWI1uP7BRuUfGQx6U3ioNUCeBVdasdaItTMxMK0jo7Pryzjg'
     }).then((token) => {
         console.log('Tokens: ' + token);
         $.getJSON("<?= base_url('registertoken/') ?>" + token, function(data) {
             console.log("Response: " + data.msg);
         });
     });


     fcm.onMessage((data) => {
         console.log("onMessage: " + JSON.stringify(data));
         let title = data.data.title;
         let body = data.data.body;
         let label = data.data.label;
         let refresh = data.data.refresh;
         const notificationOption = {
             body: data.notification.body,
             icon: data.notification.icon
         };
         const notifsimpan = {
             id: Date.now(),
             label: label,
             title: data.notification.title,
             body: data.notification.body,
             icon: data.notification.icon,
             time: new Date().toLocaleString('en-US', {
                 hour: 'numeric',
                 minute: 'numeric',
                 hour12: true
             })
         }
         createObjectNotif(notifsimpan);
         showObjectNotif();

         if ('serviceWorker' in navigator && 'PushManager' in window) {
             navigator.serviceWorker.ready
                 .then(function(registration) {
                     registration.showNotification(data.notification.title, notificationOption);
                 })
                 .catch(function(error) {
                     console.error('Gagal menampilkan notifikasi:', error);
                 });
         } else if ('Notification' in window) {
             Notification.requestPermission((status) => {
                 console.log("requestPermission: " + status);
                 if (status === 'granted') {
                     var notification = new Notification(data.notification.title, notificationOption);
                     notification.onclick = function(ev) {
                         ev.preventDefault();
                         window.open("<?= base_url('home') ?>", "_blank");
                     }
                 }
             });
         }

         var content = {};
         content.message = body;
         content.title = title;
         // content.target = '_blank';

         var notify = $.notify(content, {
             type: label,
             allow_dismiss: false,
             newest_on_top: true,
             mouse_over: false,
             showProgressbar: false,
             spacing: 10,
             timer: 3000,
             placement: {
                 from: 'top',
                 align: 'center'
             },
             offset: {
                 x: 30,
                 y: 30
             },
             delay: 1000,
             z_index: 10000,
             animate: {
                 enter: 'animated bounce',
                 exit: 'animated bounce'
             }
         });

         if (refresh) {
             setTimeout(function() {
                 location.reload();
             }, 2000);
         }
     })

     function createObjectNotif(datas) {
         let db;
         var request = indexedDB.open('nseAlazcaLive', 1);

         request.onupgradeneeded = function(event) {
             db = event.target.result;
             if (!db.objectStoreNames.contains('notifikasi')) {
                 var objectStore = db.createObjectStore('notifikasi', {
                     keyPath: 'id',
                     autoIncrement: true
                 });
                 objectStore.createIndex('timestamp', 'timestamp', {
                     unique: false
                 });
             }
         };

         request.onsuccess = function(event) {
             db = event.target.result;
             var transaction = db.transaction(['notifikasi'], 'readwrite');
             var objectStore = transaction.objectStore('notifikasi');

             var request = objectStore.add(datas);
             request.onsuccess = function(event) {
                 console.log('Pesan disimpan di IndexedDB');
             };
             request.onerror = function(event) {
                 console.error('Gagal menyimpan pesan di IndexedDB', event.target.error);
             };
         };
     }

     function showObjectNotif() {
         let db;
         var request = indexedDB.open('nseAlazcaLive', 1);
         request.onupgradeneeded = function(event) {
             db = event.target.result;
             if (!db.objectStoreNames.contains('notifikasi')) {
                 var objectStore = db.createObjectStore('notifikasi', {
                     keyPath: 'id',
                     autoIncrement: true
                 });
                 objectStore.createIndex('timestamp', 'timestamp', {
                     unique: false
                 });
             }
         };
         request.onsuccess = function(event) {
             db = event.target.result;
             var transaction = db.transaction(['notifikasi'], 'readonly');
             var objectStore = transaction.objectStore('notifikasi');
             var cursorRequest = objectStore.openCursor();
             let listnotiftext = '';
             let count = 0;
             cursorRequest.onsuccess = function(event) {
                 var cursor = event.target.result;
                 if (cursor) {
                     // Anda dapat mengakses data di sini dan menampilkannya
                     var item = cursor.value;
                     // console.log(item);
                     listnotiftext += `<li class="b-l-${item.label} border-4 notif-item" onclick="hapusNotif(${item.id})">
                    <p class="text-start">${item.body} <span class="font-danger">${item.time}</span></p>
                    </li>`;
                     count++;
                     // Lanjutkan ke entri berikutnya jika ada
                     cursor.continue();
                 } else {
                     // Semua data telah dibaca
                     $(".notification-container").html(listnotiftext);
                     $("#notification-count").text(count);
                 }
             };
             cursorRequest.onerror = function(event) {
                 console.error('Gagal membaca data dari IndexedDB', event.target.error);
             };
         };

         request.onerror = function(event) {
             console.error('Gagal membuka IndexedDB', event.target.error);
         };
     }

     function deleteObjectNotif(keyToDelete) {
         let db;
         var request = indexedDB.open('nseAlazcaLive', 1);
         request.onupgradeneeded = function(event) {
             db = event.target.result;
             if (!db.objectStoreNames.contains('notifikasi')) {
                 var objectStore = db.createObjectStore('notifikasi', {
                     keyPath: 'id',
                     autoIncrement: true
                 });
                 objectStore.createIndex('timestamp', 'timestamp', {
                     unique: false
                 });
             }
         };
         request.onsuccess = function(event) {
             db = event.target.result;
             // Selanjutnya, kita akan menjalankan transaksi untuk menghapus data.
             var transaction = db.transaction(['notifikasi'], 'readwrite');
             var objectStore = transaction.objectStore('notifikasi');
             var deleteRequest = objectStore.delete(keyToDelete);

             deleteRequest.onsuccess = function(event) {
                 console.log('Data berhasil dihapus dari IndexedDB');
             };

             deleteRequest.onerror = function(event) {
                 console.error('Gagal menghapus data dari IndexedDB', event.target.error);
             };
         };

         request.onerror = function(event) {
             console.error('Gagal membuka IndexedDB', event.target.error);
         };
     }

     function hapusNotif(id) {
         deleteObjectNotif(id);
         showObjectNotif();
     }

     function urlBase64ToUint8Array(base64String) {
         var padding = '='.repeat((4 - base64String.length % 4) % 4);
         var base64 = (base64String + padding)
             .replace(/\-/g, '+')
             .replace(/_/g, '/');

         var rawData = window.atob(base64);
         var outputArray = new Uint8Array(rawData.length);

         for (var i = 0; i < rawData.length; i++) {
             outputArray[i] = rawData.charCodeAt(i);
         }

         return outputArray;
     }
 </script>
 <script>
     new WOW().init();
     $(document).ready(function() {
         showObjectNotif();
     });
 </script>