-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Sep 08, 2022 at 07:33 PM
-- Server version: 10.9.2-MariaDB-1:10.9.2+maria~ubu2204
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `cusername` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `news_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `uid`, `cusername`, `date`, `comment`, `news_id`) VALUES
(69, 17, 'admin', '2022-09-08 22:22:05', 'sdhlkjashdsa', 1),
(70, 18, 'irmak', '2022-09-08 22:23:01', 'selamm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `poster_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `poster_link`) VALUES
(1, 'Twitter, Yanıt İstemleri Özelliğini Twitter’ı Türkçe Kullanan Herkese Getiriyor', 'Twitter, Türkçe Yanıt İstemleri özelliğinin başarılı geçen deneme sürecinden sonra, bu özelliğin 2 Ağustos’tan itibaren iOS, Android ve Web için globalde Twitter’ı Türkçe dilinde kullanan kullanıcıların tümüne sunacağını açıkladı. Twitter, bu özelliği 2022’nin başından bu yana, dünyanın çeşitli bölgelerinde test ediyordu. Reply Prompts yani Yanıt İstemleri özelliği, bir Tweet’e yanıt olarak zararlı olabilecek bir dil (hakaret, kaba dil veya nefret dolu sözler) algıladığımızda görünür. Bu özellik, insanlara yazdıklarını yeniden düşünme ve potansiyel olarak yanıtı silme veya değiştirme şansı veriyor. Twitter’dan yapılan açıklamada, şu ifadelere yer verildi: “Geçen yıl, konuşmaları daha medeni hale getirmenin ve Twitter’daki genel konuşmanın sağlığını iyileştirmenin bir yolu olarak ABD ve Brezilya’daki insanlara yönelik yanıt istemleri özelliğini başlattık. Bu test, ABD’deki kişilerin %30’unun ve Brezilya’daki kişilerin %47’sinin, sorulduktan sonra yanıtlarını değiştirmesi veya silmesiyle sonuçlandı. Bu özelliği Türkçe olarak test ettikten sonra, tüm dünyada Türkçe dil ayarlarına sahip olan herkese sunmaya hazırız. Bu başarıyı dünyanın her yerindeki insanların Twitter’daki deneyimlerine yansıtmak amacıyla bu özelliği farklı pazarlarda ve dillerde de test etmeye devam edeceğiz.”', 'https://www.technopat.net/wp-content/uploads/2016/11/twit.jpg'),
(2, 'Ericsson, Qualcomm ve Thales, 5G’yi Uzaya Taşıyacak', 'Ericsson, Fransız havacılık ve uzay şirketi Thales ve kablosuz teknoloji geliştiricisi Qualcomm Technologies ile birlikte 5G’yi dünyanın sınırlarının dışına çıkarıp, yörüngedeki uydulardan meydana gelen bir ağ oluşturmayı planlıyor.\r\n\r\nProjeyle birlikte geleceğin 5G akıllı telefonlarının kullanım alanı genişleyecek. Bu sayede yalnızca veri bağlantısı sunan geleneksel uydu telefonları yoluyla iletişim kurulabilen bölgelerle sınırlı kalınmayıp, dünyanın her yerinde 5G bağlantıdan ve geniş bant veri hizmetlerinden yararlanabilme potansiyeline erişilecek.\r\n\r\nAlçak Dünya Yörüngesinde (ADY) bulunan uydular yoluyla sağlanan 5G bağlantının en zorlu coğrafyaları; denizleri, okyanusları ve karasal bağlantı imkanının bulunmadığı diğer ücra bölgeleri kapsama alanına dahil etmesi bekleniyor.\r\n\r\nBu ölçüde yaygın bir kapsama alanının, hem 5G akıllı telefon abonelerine sunulan dolaşım hizmetlerini iyileştirmesi, hem de taşımacılık, enerji ve sağlık sektörlerinin 5G kullanım senaryolarından yararlanması amaçlanıyor.\r\n\r\nUzay tabanlı ağlar aynı zamanda karasal ağların beklenmedik kesintiler veya doğal afetler sebebiyle kullanılamadığı durumlarda yedek iletişim ağı olarak görev yapabilecek.\r\n\r\nEricsson Kıdemli Başkan Yardımcısı ve CTO’su Erik Ekudden konuyla ilgili şunları kaydetti: “Ericsson, Thales ve Qualcomm Technologies’in bu teknolojiyi test etmek ve doğrulamak için kurduğu iş birliği, iletişim tarihinde önemli bir kilometre taşı olma niteliği taşıyor. Nihayetinde bu teknoloji, birlikte çalışan 5G uydular ve karasal bağlantılar yoluyla gerek okyanusun ortasında gerek ücra bir bölgedeki ormanın içinde olsun, dünyanın her noktasındaki kullanıcılara gelişmiş, güvenli ve ulaşılabilir iletişim imkanı sunacak.\r\n\r\nEricsson Türkiye Genel Müdürü Işıl Yalçın, “Ericsson’un sınırsız olasılıklar sunan sınırsız bağlantılar vizyonu, yavaş yavaş gerçeğe dönüşüyor. Ericsson, Thales ve Qualcomm Technologies arasındaki test ve validasyon işbirliği, okyanuslar ve ormanlar gibi dünyanın en ücra ve zorlu bölgelerinde bağlantı imkanı sağlayacak. Bu da herkesin ve her şeyin, her yerden güvenli ve uygun maliyetli bir şekilde birbirine bağlanabileceği bir dünyanın kapısını aralıyor. Aynı zamanda mevcut karasal ağların doğal afetler sebebiyle hizmet vermediği durumlarda yedek iletişim ağı olarak görev yapabilecek olması da önemli bir değer yaratıyor” açıklamasını yaptı.\r\n\r\nQualcomm Technologies Mühendislikten Sorumlu Kıdemli Başkan Yardımcısı John Smee, şu açıklamayı yaptı: “5G’nin her yerde her zaman bağlantı sağlama taahhüdünün yerine getirilebilmesi için, bu ağın kapsama alanının okyanuslar ve ücra bölgeler gibi karasal hücresel ağların ulaşamadığı noktalara da genişletilmesi şart. Ericsson ve Thales ile birlikte planladığımız bu araştırma sayesinde, hayati bir öneme sahip bu teknolojiyi gerçeğe dönüştürmek yolunda önemli bir adım atmış olacağız. Bu iş birliğinin neler başarabileceğini görmek için sabırsızlanıyoruz.”\r\n\r\nThales Strateji, Araştırma ve Teknolojiden Sorumlu Kıdemli Başkan Yardımcısı Philippe Keryer, şu değerlendirmede bulundu: “5G ağlarının hizmete alınması, telekomünikasyon endüstrisi için büyük bir değişime işaret ediyor. Bu, yalnızca sunduğu iş fırsatları açısından değil, aynı zamanda milyarlarca insanı ve nesneyi birbirine bağlamak ve güvenliklerini sağlamak için sunduğu özellikler yönünden de oyunun kurallarını değiştiren bir gelişme. Thales, bu ortak araştırma grubunun birçok çalışmasıyla yakından ilgileniyor. Ericsson ve Qualcomm Technologies ile kurduğumuz bu iş birliği, 5G karasal olmayan ağların devrimsel özelliğine ve ağ dayanıklılığı ile güvenliğini sonraki seviyeye taşıma potansiyeline olan inancımızın bir göstergesi niteliğinde.”\r\n\r\nKüresel  telekomünikasyon standartları kurumu 3GPP’nin Mart 2022’de verdiği onayın ardından, Ericsson, Thales ve Qualcomm Technologies’in başlattığı bu ilk test ve validasyon çalışmasında karasal olmayan ağların desteklenmesi amaçlanıyor.\r\n\r\nTest kapsamında, 5G karasal olmayan ağları oluşturacak 5G akıllı telefonlar, uydular ve karadaki 5G ağ bileşenleri gibi çeşitli teknoloji unsurlarının validasyonu gerçekleştirilecek.\r\n\r\nEricsson, hızla hareket eden ADY uydular aracılığıyla yayılan radyo sinyallerini yakalamak üzere modifiye edilen bir 5G sanal RAN (vRAN) kümesini test ederek, uzay boşluğu ile Dünya’nın atmosferi arasında geçiş yapan 5G radyo dalgalarında ne gibi değişimler olduğu sorusuna yanıt arayacak.\r\n\r\nThales ADY uydularda kullanıma uygun bir 5G radyo uydu sistemini test etmeyi planlarken, Qualcomm Technologies ise 5G NTN’lerin geleceğin 5G akıllı telefonlarında kullanılabileceğini kanıtlamak amacıyla geliştirilmiş test telefonlarından yararlanacak.', 'https://www.technopat.net/wp-content/uploads/2022/08/Ericsson-Qualcomm-ve-Thales-5Gyi-Uzaya-Tasiyacak.jpg'),
(17, 'Microsoft .NET Framework Nedir?', 'Öncelikle bir framework nedir onu açıklayalım. Framework, içerisinde uygulama geliştirme arayüzleri (API) ve programcıların ihtiyaç duyduklarında çağırabilecekleri paylaşımlı bir kod kütüphanesi barından paketlere denir. .NET Framework’ta ise paylaşımlı kod kütüphanesi Framework Class Library (FCL) olarak adlandırılıyor. Bu kütüphanedeki kodlar pek çok çeşit fonksiyon çalıştırabiliyor. Bu sayede programcılar ufak işlemler için gerekli fonksiyonları sıfırdan yazmak zorunda kalmıyor.Diğer framework paketlerine kıyasla .NET, ayıca uygulamalar için çalışma alanı (runtime enviroment) da sunuyor. Çalışma alanları, içinde uygulamaların çalıştığı sanal makine benzeri bir kum havuzudur denebilir. Java ve Ruby on Rails gibi pek çok yazılım geliştirme platformu benzer çalışma alanları sunmaktadır. Söz konusu .NET olunca, bu çalışma alanı Common Language Runtime (CLR) olarak adlandırılır. Örneğin bir kullanıcı bir uygulamayı çalıştırdığında, uygulamanın kodları çalışma alanında makine diline derlenir ve ardından uygulama çalıştırılır.Uygulamaları çalışma alanları içinde çalıştırmanın birden fazla avantajı mevcut. Bunların en büyüğü ise uyumluluk. Geliştiriciler kodlarını C#, C++, F#, Visual Basic gibi sık kullanılan programlama dillerinde yazabilir ve ve bu kodlar .NET destekli bütün donanımlar üzerinde çalıştırılabilir.Microsoft zaman içinde .NET uygulamaları ile Windows dışı platformlar arasındaki uyumluluğu artırmak için birden fazla projeye imza attı. Bunlardan biri olan ücretsiz ve açık kaynak kodlu Mono, başta Linux olmak üzere diğer platformlar ile .NET uygulamalarını bir araya getirmek için kullanılıyor. .NET Core Framework ise benzer bir görevi hafif ve modüler çoklu platform uygulamaları için yerine getiriyor.', 'https://www.technopat.net/wp-content/uploads/2016/09/dot-net.jpg'),
(19, 'NVIDIA, RTX 4080 Özelliklerini Güncelledi: 9728 CUDA Çekirdeği', 'Üretim ortakları için ambargo uygulanan RTX 4000 serisiyle ilgili NVIDIA tarafında hareketli günler yaşanıyor. Daha önce RTX 4090 ve RTX 4070‘e ait teknik özelliklerin değiştiğini öğrenmiştik. Sürekli bilgiler sızdıran Kopite7kimi, şimdi RTX 4080’in bazı güncellemeler aldığını açıkladı. RTX 4070 tarafında haberler olumluydu lakin bu kez değil. GeForce RTX 4080, 80 yerine 76 SM (Streaming Multiprocessor) kullanacak ve CUDA çekirdeklerinin sayısı 10240’dan 9728’e düştü. Gelen bilgilere bakılırsa bellek ve TDP tarafında hiçbir değişiklik yapılmış değil. RTX 4080, varsayılan olarak 420W TDP değerine sahip olacak. Bununla birlikte, 256 bitlik veri yolunda çalışan 16 GB GDDR6X bellekler kullanılacak. RTX 4070 de dahil olmak üzere, şimdiye kadar onaylanan tüm üst düzey RTX 4000 modellerinde 21 Gbps hızında çalışan modüller yer alacak. RTX 4080 ile ilgili performans tahminlerinde bir güncelleme yapılmadı. Çekirdek sayısı küçük miktarlarda düşmüş olsa bile saat hızının yükselme ihtimalini göz önünde tutuyoruz. Bir hatırlatma olarak, RTX 4000 serisi ekran kartları muhtemelen aynı anda lansmana konuk olacak. Ancak RTX 4090, RTX 4080 ve RTX 4070’in piyasaya çıkışı birer ay arayla gerçekleşebilir.', 'https://www.technopat.net/wp-content/uploads/2022/01/NVIDIA-GeForce-RTX-3080.jpg'),
(43, 'Windows 11 Yazıcı Özellikleri Windows 10’a Geliyor', 'Windows 10 için güncellemeler yayınlamaya devam eden Microsoft, zaman zaman Windows 11’in yeni özelliklerini eski işletim sistemine getirmeyi tercih edebiliyor. Şirket kısa zaman önce sürüm 22H2 ile birlikte bir dizi yeni özellik getireceğini müjdelemişti. Redmond devi, yeni PIN ekleme özelliğiyle birlikte yazıcı deneyimini geliştirmeyi planlıyor. Bir yazdırma işlemine PIN eklendiğinde, siz yazıcıya aynı kodu girene kadar seçtiğiniz belge yazdırılmayacak. Bu özelliğin amacı, çoklu bağlantıya sahip sistemlerde yanlış çıktılardan kaçınmak. Microsoft’a göre PIN entegrasyonu kağıt ve toner israfını azaltabilecek bir işlev. Aynı zamanda, özellikle birden fazla yazıcının olduğu bir ortamda kullanıcılara gizlilik ve artırılmış güvenlik de sağlayacak. Öte yandan kurumsal müşteriler için Windows 10’a Print Support App (PSA) platform desteği de ekleniyor. Bu platform, şirketlerin yeni bir sürücü yüklemeden yazdırma deneyimine özellikler ve iş akışları eklemesine olanak tanıyor. Yeni yazıcı özellikleri Build 19044.1806 (KB5014666) ile birlikte test kullanıcılarına ulaşmıştı. Aynı güncelleme ayrıca Windows 10’da Odaklanma yardımı açıkken önemli bildirimleri almanızı sağlayan bir tüketici dostu özellik de içeriyordu. Bu özellik KB5016616 ile kullanıma sunuldu ve bazı yazdırma sorunları da çözüme kavuşmuştu.', 'https://www.technopat.net/wp-content/uploads/2022/08/Windows-10-Yeni-Bir-Yazdirma-Ozelligi-Aliyor.jpg'),
(44, 'Windows 10 22H2 Güncellemesi Yeni Özelliklerle Gelecek', 'Son aylarda Windows 11 işletim sistemine odaklanan Microsoft, Windows 10’u unutmayarak yeni güncellemeler sunmaya devam ediyor. Microsoft yetkililerine göre Windows 10 önemli bir rol oynamaya devam ediyor ve Windows 10 22H2 bu yıl içinde müşterilere sunulmaya başlayacak. Redmond devinin Windows 10’a eskisi kadar eğilmediğini biliyoruz, ancak önümüzdeki güncelleme önemli şeyler getirebilir. Bir şirket sözcüsü, bu özellik güncellemesinin “kapsamlı bir dizi yeni özellik” ile gönderileceğini ve daha fazla ayrıntının yakında paylaşılacağını söyledi.Bildiğiniz gibi Windows 10 en az 2025’e kadar desteklenmeye devam edecek. İşletim sisteminin halen 1 milyardan fazla kullanıcısı olduğunu tahmin ediyoruz, bu nedenle Microsoft’un destek sunması gayet doğal. Ek olarak, destek belgelerinde sürüm 22H2’nin Windows 10 sürüm 2004’ün üzerine kurulduğu ve “Windows Donanım Uyumluluk Programında (WHCP)” herhangi bir değişiklik getirmeyeceği doğrulanmıştı. Kısa süre önce gelen toplu güncellemelerden (KB5015684) birinde Windows 10 22H2 ile ilgili referanslar ortaya çıktı. Bu güncelleme resmi olarak Windows Insider programına ulaştı ve işletim sistemi sürümü 21H2’den 22H2’ye yükseliyor.', 'https://www.technopat.net/wp-content/uploads/2021/04/kare-orani-dusuren-windows-10-guncellemesi-duzeltildi.jpg'),
(46, 'Windows 11 Şifreleme Hatası Veri Kayıplarına Yol Açıyor', 'Microsoft, Windows’un en yeni sürümlerinde veri bozulmasına neden olabilecek şifreleme sorununu kabul ederken konuyla ilgili bir makale yayınladı. Yazılım devi, “ortaya çıkabilecek daha fazla hasarı önlemek amacıyla” Windows 11 ve Windows Server 2022 için sunulan Haziran 2022 güvenlik güncellemelerini yüklemenizi öneriyor. Ancak hata nedeniyle kullanıcılar verilerini zaten kaybettiği için herkes için önerilen bir çözüm yok. Bahsi geçen sorunlar, kriptografik işlemleri hızlandırmak için Vector Advanced Encryption Standard (VAES) komutlarını destekleyen nispeten yeni bilgisayarları ve sunucuları etkiliyor. AVX-512 komut setinin bir parçası olan VAES komutları, Intel’in Ice Lake, Tiger Lake, Rocket Lake ve Alder Lake mimarileri tarafından destekleniyor. Başka bir deyişle, bazı dizüstü bilgisayarlar da dahil olmak üzere 10. nesil, 11. nesil ve 12. nesil işlemciler bu problemden olumsuz etkileniyor. Aslında AMD’nin Zen 4 mimarisi de VAES’i destekliyor, ancak bu yongalar piyasaya çıkana kadar birçok yama hazırlanabilir. Microsoft, sorunun Windows’un şifreleme kütüphanesi SymCrypt’teki güncellenmiş şifreleme talimatlarını desteklemek için “yeni kod yolları” eklendiğinde ortaya çıktığını söylüyor. Kod yolları Windows 11 ve Windows Server 2022’nin ilk sürümünde eklendi. Bu nedenle hatalardan Windows 10 veya Windows Server 2019 gibi eski işletim sistemleri etkilenmiyor. İlk düzeltmeler Windows’un Haziran 2022 güvenlik güncellemesiyle (Windows 11 Build 22000.778) yayınlanmıştı. Microsoft, düşük performans pahasına daha fazla hasarı önlemek amacıyla bazı değişiklikler yaptı. Bu noktada işlemcilerde şifreleme hızlandırma özelliğinin devre dışı bırakıldığı söyleniyor. Ayrıca Temmuz 2022 güvenlik güncellemeleriyle (Windows 11 Build 22000.795) birlikte performansın eski düzeye geri döneceği belirtilmiş.', 'https://www.technopat.net/wp-content/uploads/2020/11/Guvenlik-Islemci-CPU-Windows-Microsoft-Pluton.jpg'),
(47, 'Intel İşlemcilerde Mimari Tabanlı Güvenlik Açığı Keşfedildi: ÆPIC Leak', 'x86 CPU ailesi, arkasındaki şirket fark etmeksizin son yıllarda birçok saldırıya açık hale geldi. Üreticiler her ne kadar yamalar için çalışıyor olsa da her geçen gün yeni bir istismar ortaya çıkıyor. Spectre ve Meltdown bildiğiniz gibi hem AMD hem de Intel işlemcileri çok etkiledi. Şimdi ise 10. nesil, 11. nesil ve 12. nesil Intel Core işlemcileri etkileyen “ÆPIC Leak” adlı yeni bir güvenlik açığı gün yüzüne çıktı. Adını Gelişmiş Programlanabilir Kesinti Denetleyicisinden (Advanced Programmable Interrupt Controller-APIC) alan sızıntının “hassas verileri mimari olarak ifşa edebilen” ilk CPU açığı olduğu iddia ediliyor. Intel imzalı işlemcilerdeki bu kusuru Pietro Borrello (Roma Sapienza Üniversitesi), Andreas Kogler (Graz Teknoloji Enstitüsü), Martin Schwarzl (Graz), Moritz Lipp (Amazon Web Servisleri), Daniel Gruss (Graz Teknoloji Üniversitesi) ve Michael Schwarz (CISPA Helmholtz Merkezi Bilgi Güvenliği) gibi araştırmacılar keşfetti. “ÆPIC Leak, hassas verileri mimari tabanlı olarak ifşa edebilen ilk CPU hatasıdır. İşlemcinin kendisinden verileri sızdırmak için son Intel CPU’larındaki bir güvenlik açığından yararlanmakta: APIC MMIO, 10, 11 ve 12. nesil Intel CPU’ların çoğunda önbellek hiyerarşisinden eski verileri yanlış döndürmekte. Meltdown ve Spectre gibi geçici yürütme saldırılarının aksine, ÆPIC Leak mimari tabanlı bir hata: hassas veriler herhangi bir yan kanala dayanmadan doğrudan ifşa edilebiliyor. APIC MMIO’ya erişmek için ayrıcalıklara sahip bir saldırgan (yönetici veya kök) gerekir. Bu nedenle çoğu sistem ÆPIC Leak’e karşı güvenli. Ancak, verileri ayrıcalıklı saldırganlardan korumak için SGX’e dayanan sistemler risk altında olacağından, yama yapılması gerekir.” CVE-2022-2123 etiketi taşıyan güvenlik açığının Aralık 2021’de Intel’e bildirildiği söyleniyor. Ek olarak, şu anda şirketin söz konusu istismar ile ilgili bir çalışma yapıp yapmadığını bilmiyoruz.', 'https://www.technopat.net/wp-content/uploads/2022/08/Intel-Islemcilerde-Mimari-Tabanli-Guvenlik-Acigi-Kesfedildi-AEPIC-Leak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `userGroup` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'Standard User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `userGroup`) VALUES
(13, 'ataberk', '$2y$10$SHCsm2RTRgLzBO8lgazfX.4NkEIXSWWj6WRit4l4GAnl.HFBiAHXu', 'Standard User'),
(16, 'ataberkk', '$2y$10$q6pr3dRNIlvi/A/J0NyEMOs/cSp8W8AzChSe9/nXo5f0710GoNnj.', 'Standard User'),
(17, 'admin', '$2y$10$aNg2ge8VLg0FRKBvonicseWmDJWxtJ7yKwTRUJQWM1pWn4VBodZiu', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
