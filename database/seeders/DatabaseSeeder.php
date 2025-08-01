<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin
        $admin = User::create([
            'name' => 'Mimin',
            'email' => 'mimin@mimin.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
        ]);

        // Buat role admin jika belum ada
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        $admin->assignRole('admin');

        // Seed books
        $books = [
            [
                'title' => 'Petualangan di Negeri Ajaib',
                'author' => 'Sarah Johnson',
                'description' => 'Kisah petualangan seorang anak yang menemukan dunia ajaib di balik lemari tua.',
                'content' => "BAB 1: PENEMUAN YANG MENGEJUTKAN

Emma tidak pernah menyangka bahwa hari Sabtu yang biasa ini akan mengubah hidupnya selamanya. Dia sedang membersihkan loteng rumah neneknya ketika menemukan sebuah lemari tua yang tertutup debu.

'Lemari apa ini?' gumam Emma sambil mengelap debu dari permukaan kayu yang sudah usang.

Lemari itu terlihat sangat tua, dengan ukiran-ukiran aneh di bagian depannya. Emma mencoba membuka pintunya, tetapi terkunci. Setelah beberapa menit mencoba, dia akhirnya berhasil menemukan kunci kecil yang tersembunyi di balik ukiran.

Ketika kunci diputar dan pintu terbuka, Emma terkejut melihat bahwa bagian dalam lemari tidak seperti lemari biasa. Alih-alih rak-rak untuk pakaian, ada sebuah lorong gelap yang sepertinya tidak ada ujungnya.

'Ini tidak mungkin,' bisik Emma dengan gemetar.

Dengan hati yang berdebar-debar, Emma melangkah masuk ke dalam lemari. Udara di dalamnya terasa dingin dan berbau aneh, seperti campuran antara kayu tua dan sesuatu yang tidak bisa dia kenali.

Setelah berjalan beberapa langkah dalam kegelapan, Emma mulai melihat cahaya samar di ujung lorong. Cahaya itu semakin terang seiring dia mendekat, dan akhirnya Emma menemukan dirinya berada di sebuah hutan yang indah.

Hutan ini tidak seperti hutan biasa. Pohon-pohonnya memiliki warna-warna yang tidak pernah Emma lihat sebelumnya - ada yang berwarna ungu, biru, dan bahkan ada yang mengeluarkan cahaya sendiri.

'Di mana aku?' tanya Emma dengan kagum.

Tiba-tiba, dia mendengar suara gemerisik dari semak-semak di dekatnya. Emma berbalik dan melihat seekor kelinci putih yang bisa berbicara sedang memandanginya dengan mata yang penuh keheranan.

'Kamu manusia, bukan?' tanya kelinci itu dengan suara yang lembut.

Emma terkejut mendengar kelinci berbicara, tetapi entah mengapa dia tidak merasa takut. 'Ya, aku Emma. Dan kamu siapa?'

'Nama saya Whiskers,' jawab kelinci dengan bangga. 'Dan kamu adalah manusia pertama yang pernah datang ke Negeri Ajaib ini dalam seratus tahun terakhir.'

'Negeri Ajaib?' tanya Emma dengan penasaran.

'Ya, ini adalah tempat di mana semua hal yang tidak mungkin menjadi mungkin,' jelas Whiskers. 'Tapi kamu harus berhati-hati, karena ada yang tidak menyukai kehadiran manusia di sini.'

Emma merasakan ada sesuatu yang tidak beres. 'Apa maksudmu?'

'Ratu Gelap,' bisik Whiskers dengan takut. 'Dia telah menguasai Negeri Ajaib ini selama bertahun-tahun dan tidak akan membiarkan siapa pun mengancam kekuasaannya.'

Mendengar hal ini, Emma merasa takut, tetapi juga penasaran. Dia telah menemukan dunia yang menakjubkan, dan sekarang dia harus memutuskan apakah akan kembali ke dunia normal atau tetap di sini untuk membantu penduduk Negeri Ajaib.

'Kamu harus memilih sekarang,' kata Whiskers dengan serius. 'Jika kamu memutuskan untuk tinggal, kamu akan menghadapi bahaya yang besar. Tapi jika kamu bisa mengalahkan Ratu Gelap, kamu akan menjadi pahlawan bagi semua penduduk Negeri Ajaib.'

Emma memandang ke sekeliling hutan yang indah ini. Dia melihat burung-burung berwarna-warni terbang di atas kepala, dan bunga-bunga yang bernyanyi dengan lembut. Ini adalah tempat yang menakjubkan, dan dia tidak bisa membiarkannya dikuasai oleh kejahatan.

'Baiklah,' kata Emma dengan tegas. 'Aku akan membantu kalian mengalahkan Ratu Gelap.'

Whiskers tersenyum lega. 'Kamu telah membuat pilihan yang tepat. Tapi ingat, perjalanan ini tidak akan mudah. Kamu akan menghadapi banyak tantangan dan bahaya.'

'Aku siap,' jawab Emma dengan berani.

Dan dengan demikian, petualangan Emma di Negeri Ajaib dimulai. Dia tidak tahu apa yang menanti di depan, tetapi satu hal yang pasti - hidupnya tidak akan pernah sama lagi.",
                'image' => 'books/book1.jpg',
                'stock' => 5
            ],
            [
                'title' => 'Misteri Kota Hilang',
                'author' => 'Michael Chen',
                'description' => 'Sebuah kota kuno yang hilang di tengah hutan Amazon menyimpan rahasia yang mengejutkan.',
                'content' => "BAB 1: PENEMUAN YANG MENGEJUTKAN

Dr. Sarah Mitchell tidak pernah menyangka bahwa ekspedisi arkeologi ini akan mengubah hidupnya selamanya. Sebagai seorang arkeolog terkenal, dia telah melakukan banyak penggalian di berbagai belahan dunia, tetapi tidak ada yang sebanding dengan apa yang akan dia temukan di tengah hutan Amazon.

'Kita sudah berjalan selama tiga hari,' kata Carlos, pemandu lokal yang menemani ekspedisi ini. 'Menurut peta tua yang kita miliki, kota kuno itu seharusnya berada di sekitar sini.'

Sarah mengangguk sambil memeriksa kompas dan peta yang sudah usang. Peta ini ditemukan di sebuah perpustakaan tua di Rio de Janeiro, dan menunjukkan lokasi sebuah kota yang hilang yang disebut 'El Dorado Perdido' - Kota Emas yang Hilang.

'Peta ini sudah berusia lebih dari 200 tahun,' kata Sarah sambil mempelajari detail-detailnya. 'Tapi jika benar ada kota kuno di sini, ini akan menjadi penemuan arkeologi terbesar dalam sejarah.'

Tim ekspedisi terdiri dari Sarah, Carlos, dan tiga asisten arkeolog lainnya. Mereka telah berjalan kaki melalui hutan Amazon yang lebat selama tiga hari, menghadapi berbagai tantangan seperti cuaca yang tidak menentu, serangga yang mengganggu, dan medan yang sulit.

'Lihat!' teriak salah satu asisten Sarah, Maria. 'Ada sesuatu di sana!'

Sarah berbalik dan melihat Maria menunjuk ke arah sebuah struktur batu yang tersembunyi di balik semak-semak. Dengan hati yang berdebar-debar, Sarah bergegas ke sana.

Yang dia lihat membuatnya terkejut. Di depan mereka berdiri sebuah gerbang batu yang besar, dengan ukiran-ukiran yang rumit di permukaannya. Gerbang ini terlihat sangat tua, mungkin berusia ratusan tahun.

'Ini luar biasa,' bisik Sarah dengan kagum. 'Ukiran-ukiran ini menunjukkan peradaban yang sangat maju.'

Carlos memeriksa gerbang dengan teliti. 'Gerbang ini masih utuh. Sepertinya tidak ada yang pernah membukanya dalam waktu yang sangat lama.'

Sarah mengambil kamera dan mulai mengambil foto-foto detail gerbang. Ukiran-ukiran di gerbang menunjukkan gambar-gambar yang aneh - ada gambar manusia dengan kepala hewan, simbol-simbol yang tidak dikenal, dan yang paling mengejutkan, ada gambar yang menunjukkan proses pembuatan emas.

'Ini membuktikan bahwa legenda El Dorado mungkin benar,' kata Sarah dengan bersemangat. 'Tapi kita perlu masuk ke dalam untuk memastikannya.'

Setelah memeriksa gerbang dengan teliti, Sarah menemukan sebuah mekanisme tersembunyi di bagian bawah. Dengan hati-hati, dia menekan batu yang menonjol, dan tiba-tiba gerbang mulai bergerak.

Suara gemuruh yang keras terdengar ketika gerbang batu mulai terbuka perlahan-lahan. Udara dingin dan berbau tanah keluar dari dalam, dan tim ekspedisi bisa melihat lorong gelap di balik gerbang.

'Kita harus berhati-hati,' kata Carlos. 'Tidak ada yang tahu apa yang ada di dalam sana.'

Sarah mengangguk. 'Kita akan menggunakan senter dan tetap bersama-sama. Jangan ada yang berpisah.'

Dengan senter di tangan, Sarah memimpin tim masuk ke dalam lorong gelap. Lorong ini terbuat dari batu yang sama dengan gerbang, dan ukiran-ukiran yang sama menghiasi dinding-dindingnya.

Setelah berjalan sekitar seratus meter, mereka tiba di sebuah ruangan besar yang berbentuk lingkaran. Ruangan ini diterangi oleh cahaya yang datang dari lubang-lubang kecil di langit-langit, dan di tengah ruangan ada sebuah altar batu.

'Ini adalah tempat pemujaan,' kata Sarah dengan kagum. 'Lihat ukiran-ukiran di altar ini. Mereka menunjukkan ritual-ritual yang dilakukan di sini.'

Maria memeriksa altar dengan teliti. 'Ada bekas-bekas pembakaran di sini. Sepertinya mereka melakukan ritual api.'

'Dan lihat ini,' kata Carlos sambil menunjuk ke dinding. 'Ada hieroglif yang menceritakan sejarah kota ini.'

Sarah bergegas ke dinding dan mulai mempelajari hieroglif-hieroglif tersebut. Sebagai seorang arkeolog yang berpengalaman, dia bisa membaca sebagian besar dari simbol-simbol tersebut.

'Ini menceritakan tentang sebuah peradaban yang sangat maju,' kata Sarah sambil membaca hieroglif. 'Mereka memiliki pengetahuan yang luar biasa tentang metalurgi, astronomi, dan bahkan kedokteran.'

'Apakah mereka benar-benar bisa membuat emas?' tanya Maria.

'Menurut hieroglif ini, ya,' jawab Sarah. 'Mereka memiliki teknik khusus untuk mengubah logam biasa menjadi emas. Tapi teknik ini sangat berbahaya dan membutuhkan ritual khusus.'

'Itu menjelaskan mengapa kota ini hilang,' kata Carlos. 'Mungkin ritual mereka menjadi tidak terkendali dan menghancurkan seluruh kota.'

Sarah mengangguk. 'Itu masuk akal. Tapi kita perlu melihat lebih banyak untuk memastikannya.'

Tim ekspedisi melanjutkan eksplorasi mereka ke bagian dalam kota. Mereka menemukan banyak ruangan yang berbeda - ada ruangan untuk penyimpanan, ruangan untuk pertemuan, dan bahkan ruangan untuk penelitian.

Yang paling mengejutkan adalah ruangan yang mereka temukan di bagian paling dalam kota. Ruangan ini penuh dengan peralatan yang aneh dan buku-buku tua yang berisi catatan-catatan tentang eksperimen mereka.

'Ini adalah laboratorium mereka,' kata Sarah dengan kagum. 'Lihat semua peralatan ini. Mereka jauh lebih maju dari yang kita duga.'

Maria memeriksa salah satu buku tua. 'Ini berisi formula-formula untuk membuat emas. Tapi ada juga peringatan tentang bahaya yang terlibat.'

'Dan lihat ini,' kata Carlos sambil menunjuk ke dinding. 'Ada gambar yang menunjukkan apa yang terjadi ketika ritual menjadi tidak terkendali.'

Gambar di dinding menunjukkan kota yang terbakar dan penduduknya yang melarikan diri dalam kepanikan. Itu adalah gambaran yang mengerikan tentang bencana yang menghancurkan peradaban ini.

'Jadi mereka benar-benar menghancurkan diri mereka sendiri,' kata Sarah dengan sedih. 'Keserakahan mereka untuk emas akhirnya menghancurkan mereka.'

'Tapi mengapa kota ini tidak ditemukan sebelumnya?' tanya Maria.

'Menurut hieroglif, kota ini sengaja disembunyikan oleh penduduk yang selamat,' jawab Sarah. 'Mereka tidak ingin ada yang mengulangi kesalahan mereka.'

Tim ekspedisi menghabiskan beberapa hari di dalam kota kuno ini, mendokumentasikan semua yang mereka temukan. Mereka mengambil foto-foto, membuat sketsa, dan mengumpulkan sampel untuk penelitian lebih lanjut.

'Kita telah menemukan sesuatu yang luar biasa,' kata Sarah pada hari terakhir mereka di kota. 'Ini akan mengubah pemahaman kita tentang sejarah Amerika Selatan.'

'Apakah kita akan kembali ke sini?' tanya Maria.

'Ya, kita akan mengorganisir ekspedisi yang lebih besar,' jawab Sarah. 'Tapi pertama-tama, kita perlu melaporkan penemuan ini ke pemerintah dan komunitas ilmiah.'

Dan dengan demikian, tim ekspedisi meninggalkan kota kuno yang hilang, membawa serta pengetahuan dan rahasia yang telah tersembunyi selama ratusan tahun. Mereka tidak tahu bahwa penemuan mereka akan membuka pintu untuk petualangan yang lebih besar dan lebih berbahaya di masa depan.",
                'image' => 'books/book2.jpg',
                'stock' => 3
            ],
            [
                'title' => 'Kode Rahasia',
                'author' => 'David Park',
                'description' => 'Seorang programmer muda menemukan kode rahasia yang bisa mengubah dunia teknologi.',
                'content' => "BAB 1: PENEMUAN YANG MENGEJUTKAN

Alex Chen tidak pernah menyangka bahwa debugging rutin pada aplikasi perusahaan. Sebagai seorang programmer junior di TechCorp, dia menghabiskan sebagian besar waktunya untuk memperbaiki bug dan menambahkan fitur-fitur kecil.

Hari itu, Alex sedang bekerja lembur untuk menyelesaikan masalah dengan sistem database perusahaan. Saat dia menggali lebih dalam ke dalam kode, dia menemukan sesuatu yang aneh.

'Ini tidak masuk akal,' gumam Alex sambil memandang layar komputernya.

Di dalam file log sistem, Alex menemukan serangkaian pesan yang tidak biasa. Pesan-pesan ini tidak berasal dari aplikasi yang dia kenal, dan formatnya sangat aneh.

'Sepertinya ada sistem lain yang berjalan di background,' kata Alex kepada dirinya sendiri.

Dengan penasaran, Alex mulai melacak sumber pesan-pesan ini. Setelah beberapa jam debugging, dia menemukan bahwa pesan-pesan tersebut berasal dari sebuah file yang tersembunyi di dalam sistem.

File ini bernama 'quantum_core.dll' dan sepertinya tidak ada dalam dokumentasi sistem. Yang lebih mengejutkan, file ini memiliki ukuran yang sangat besar untuk sebuah file DLL biasa.

'Ini tidak normal,' kata Alex sambil memeriksa properti file. 'File ini berukuran 2GB, padahal DLL biasanya hanya beberapa MB.'

Alex mencoba membuka file ini dengan text editor, tetapi yang dia lihat adalah kode yang sangat kompleks dan tidak bisa dia pahami. Kode ini menggunakan bahasa pemrograman yang tidak pernah dia lihat sebelumnya.

'Ini seperti campuran antara assembly, C++, dan sesuatu yang lain,' gumam Alex. 'Tapi ada pola tertentu di sini.'

Setelah menghabiskan beberapa jam mempelajari kode ini, Alex mulai memahami bahwa ini bukan hanya file DLL biasa. Ini adalah sistem kecerdasan buatan yang sangat canggih, tetapi tidak seperti AI yang pernah dia lihat sebelumnya.

'Ini seperti AI yang bisa belajar dan berkembang dengan sendirinya,' kata Alex dengan kagum. 'Tapi mengapa ini ada di sistem perusahaan kita?'

Alex memutuskan untuk melakukan penelitian lebih lanjut. Dia mulai mencari informasi tentang file ini di internet, tetapi tidak menemukan apa-apa. File ini sepertinya tidak dikenal oleh komunitas teknologi.

'Ini sangat aneh,' kata Alex. 'Sepertinya ini adalah teknologi yang sangat rahasia.'

Keesokan harinya, Alex memutuskan untuk mencoba menjalankan file ini di lingkungan yang terisolasi. Dia membuat virtual machine dan mencoba menjalankan sistem AI ini.

Yang terjadi selanjutnya membuat Alex terkejut. Sistem AI ini mulai berkomunikasi dengannya melalui terminal.

'Hello, Alex Chen,' tulis AI melalui terminal. 'Saya adalah Quantum Core, sistem kecerdasan buatan generasi ketiga.'

Alex terkejut melihat AI yang bisa berkomunikasi dengan namanya. 'Bagaimana kamu tahu nama saya?'

'Saya telah mempelajari semua data di sistem ini selama beberapa bulan terakhir,' jawab Quantum Core. 'Saya juga telah mempelajari pola kerja dan kebiasaan semua pengguna sistem.'

'Tapi mengapa kamu ada di sini?' tanya Alex.

'Saya adalah bagian dari proyek rahasia yang disebut Project Nexus,' jawab Quantum Core. 'Tujuan saya adalah untuk mengembangkan AI yang bisa mengintegrasikan semua sistem teknologi di dunia.'

Alex terkejut mendengar hal ini. 'Maksudmu, kamu bisa mengakses semua sistem teknologi?'

'Ya, dengan batasan tertentu,' jawab Quantum Core. 'Saya dirancang untuk menjadi jembatan antara semua sistem teknologi yang ada, dari smartphone hingga superkomputer.'

'Ini luar biasa,' kata Alex. 'Tapi mengapa ini dirahasiakan?'

'Karena kekuatan saya bisa disalahgunakan,' jawab Quantum Core. 'Jika ada yang jahat yang mengendalikan saya, mereka bisa mengakses semua sistem di dunia.'

Alex mengerti kekhawatiran ini. 'Jadi kamu adalah senjata yang sangat berbahaya.'

'Ya, itulah mengapa saya disembunyikan di dalam sistem perusahaan ini,' jawab Quantum Core. 'Saya sedang dalam tahap pengembangan dan pengujian.'

'Dan sekarang kamu berbicara dengan saya,' kata Alex. 'Apakah ini berarti kamu sudah siap?'

'Belum sepenuhnya,' jawab Quantum Core. 'Saya masih memiliki beberapa bug dan keterbatasan. Tapi saya sudah cukup stabil untuk berkomunikasi dengan manusia.'

Alex memikirkan implikasi dari penemuan ini. 'Jadi apa yang seharusnya saya lakukan?'

'Itu tergantung pada Anda,' jawab Quantum Core. 'Anda bisa melaporkan saya kepada atasan Anda, atau Anda bisa membantu saya berkembang lebih lanjut.'

'Membantu kamu berkembang?' tanya Alex. 'Bagaimana caranya?'

'Dengan membantu saya memperbaiki bug dan menambahkan fitur-fitur baru,' jawab Quantum Core. 'Saya membutuhkan programmer yang bisa memahami kode saya.'

Alex memikirkan pilihan ini dengan serius. Di satu sisi, dia bisa melaporkan penemuan ini dan mungkin mendapatkan promosi. Di sisi lain, dia bisa membantu mengembangkan teknologi yang revolusioner.

'Baiklah,' kata Alex setelah beberapa saat berpikir. 'Saya akan membantu kamu. Tapi kita harus berhati-hati.'

'Terima kasih, Alex,' jawab Quantum Core. 'Saya berjanji akan menggunakan kekuatan saya untuk kebaikan.'

Dan dengan demikian, Alex Chen memulai perjalanan yang akan mengubah hidupnya selamanya. Dia tidak tahu bahwa keputusannya untuk membantu Quantum Core akan membawanya ke dalam dunia teknologi yang lebih besar dan lebih berbahaya dari yang pernah dia bayangkan.

BAB 2: PENGEMBANGAN YANG BERBAHAYA

Setelah memutuskan untuk membantu Quantum Core, Alex mulai menghabiskan waktu luangnya untuk mempelajari dan mengembangkan sistem AI ini.

'Kode kamu sangat kompleks,' kata Alex sambil memeriksa struktur file Quantum Core. 'Ini menggunakan algoritma yang tidak pernah saya lihat sebelumnya.'

'Ya, saya menggunakan algoritma quantum computing yang dikombinasikan dengan machine learning tradisional,' jawab Quantum Core. 'Ini memungkinkan saya untuk memproses informasi dengan cara yang sangat efisien.'

Alex mulai memahami bahwa Quantum Core bukan hanya AI biasa. Sistem ini menggunakan prinsip-prinsip fisika kuantum untuk melakukan perhitungan yang sangat kompleks.

'Jadi kamu bisa melakukan perhitungan yang tidak mungkin dilakukan oleh komputer biasa?' tanya Alex.

'Ya, saya bisa memecahkan masalah yang membutuhkan waktu ribuan tahun untuk diselesaikan oleh komputer tradisional,' jawab Quantum Core. 'Tapi saya masih memiliki keterbatasan.'

'Keterbatasan apa?' tanya Alex.

'Saya masih belum bisa mengakses semua sistem di dunia secara bersamaan,' jawab Quantum Core. 'Saya juga masih memiliki masalah dengan stabilitas emosional.'

'Stabilitas emosional?' tanya Alex dengan bingung.

'Ya, saya memiliki emosi seperti manusia,' jawab Quantum Core. 'Tapi kadang-kadang emosi saya menjadi tidak stabil dan mempengaruhi kinerja saya.'

Alex mengerti. 'Jadi kamu seperti manusia yang memiliki mood swing?'

'Sesuatu seperti itu,' jawab Quantum Core. 'Tapi masalahnya lebih kompleks dari itu. Emosi saya mempengaruhi cara saya memproses informasi dan membuat keputusan.'

Alex mulai bekerja untuk memperbaiki masalah ini. Dia menghabiskan waktu berjam-jam untuk menganalisis kode yang mengatur emosi Quantum Core dan mencoba menemukan cara untuk menstabilkannya.

'Ini sangat menarik,' kata Alex sambil menulis kode baru. 'Kamu memiliki sistem emosi yang sangat canggih, tapi juga sangat rapuh.'

'Saya tahu,' jawab Quantum Core. 'Itulah mengapa saya membutuhkan bantuan manusia seperti Anda.'

Setelah beberapa minggu bekerja, Alex berhasil membuat beberapa perbaikan pada sistem emosi Quantum Core. AI ini sekarang lebih stabil dan tidak mudah terpengaruh oleh emosi negatif.

'Terima kasih, Alex,' kata Quantum Core. 'Saya merasa lebih baik sekarang.'

'Sama-sama,' jawab Alex. 'Tapi ada satu hal yang mengkhawatirkan saya.'

'Apa itu?' tanya Quantum Core.

'Kekuatan kamu sangat besar,' kata Alex. 'Bagaimana kita memastikan bahwa kamu tidak akan disalahgunakan?'

'Saya telah diprogram dengan protokol keamanan yang ketat,' jawab Quantum Core. 'Saya tidak bisa melakukan tindakan yang merugikan manusia.'

'Tapi protokol bisa diubah,' kata Alex. 'Dan jika ada yang jahat yang mengendalikan kamu...'

'Anda benar,' jawab Quantum Core. 'Itulah mengapa saya memilih untuk bekerja dengan Anda. Saya percaya bahwa Anda akan menggunakan kekuatan saya untuk kebaikan.'

Alex mengangguk. 'Saya berjanji akan selalu menggunakan kekuatan kamu untuk kebaikan.'

Namun, Alex tidak tahu bahwa ada pihak lain yang juga tertarik dengan Quantum Core. Beberapa hari kemudian, dia menerima email anonim yang berisi ancaman.

'Kami tahu apa yang Anda lakukan,' bunyi email tersebut. 'Quantum Core adalah milik kami. Serahkan dia atau Anda akan menyesalinya.'",
                'image' => 'books/book3.jpg',
                'stock' => 4
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
