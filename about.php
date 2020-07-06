
<?php
	session_start();
	$pageTitle = "Home";
	include 'init.php';
	$slider=getImagesArray("about");
	slider($slider);
?>
	
	<!-- Start About Egypt Section -->
	<section class="Details testimonials text-center wow flipInY" data-wow-duration="2s" data-wow-offset="600" style="background-color: #EA0">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
		<div class="Details_Box" >
			<h2 class="">Egypt Culture</h2>
			<p>
				The culture of Egypt has thousands of years of recorded history. Ancient Egypt was among the earliest civilizations in Africa. For millennia, Egypt maintained a strikingly unique, complex and stable culture that influenced later cultures of Europe. After the Pharaonic era, Egypt itself came under the influence of Hellenism, for a time Christianity and later, Islamic culture.
			</p>
			</div>
				</div>
			<div class="col-lg-6">
				<div class="Image_Box animated slideInUp">
			<img src="<?php echo $images.'/about/1.jpg'?>">
			</div>
				</div>
			<div class="col-lg-12">
				<p></p>
			</div>
		</div>
		</div>
	</section>
		<!-- End About Type Section -->
			<!-- Start About Egypt Section -->
	<section class="Details">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 ">
		<div class="Details_Box">
			<h2>Languages</h2>
			<p>
				The Egyptian language, which formed a separate branch among the family of Afro-Asiatic languages, was among the first written languages and is known from the hieroglyphic inscriptions preserved on monuments and sheets of papyrus. The Coptic language, the last stage of Egyptian, is today the liturgical language of the Coptic Orthodox Church. Hieroglyphs were written on people's front doors so that the news of the pharaoh would travel to everyone.

				The "Koiné" dialect of the Greek language was important in Hellenistic Alexandria, and was used in the philosophy and science of that culture, and was later studied by Arabic scholars.

				Arabic came to Egypt in the 7th century, [1] and Egyptian Arabic has become today the modern speech of the country. Of the many varieties of Arabic, it is the most widely spoken second dialect, due to the influence of Egyptian cinema and media throughout the Arabic-speaking world.

				In the lower Nile Valley, around Kom Ombo and Aswan, there are about 300,000 speakers of Nubian languages, mainly Nobiin, but also Kenuzi-Dongola. The Berber languages are represented by Siwi, spoken by about 5,000 around the Siwa Oasis. There are over a million speakers of the Domari language (an Indo-Aryan language related to Romany), mostly living north of Cairo, and there are about 60,000 Greek speakers in Alexandria. Approximately 77,000 speakers of Bedawi (a Beja language) live in the Eastern Desert.
			</p>
			</div>
				</div>
			<div class="col-lg-6">
				<div class="Image_Box">
<img src="<?php echo $images.'/about/2.jpg'?>">
			</div>
				</div>
			<div class="col-lg-12">
				<p></p>
			</div>
		</div>
		</div>
	</section>
		<!-- End About Type Section -->
			<!-- Start About Egypt Section -->
	<section class="Details">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 ">
		<div class="Details_Box">
			<h2>Literature</h2>
			<p>
				Many Egyptians believed that when it came to a death of their Pharaoh, they would have to bury the Pharaoh deep inside the Pyramid. The ancient Egyptian literature dates back to the Old Kingdom, in the third millennium BC. Religious literature is best known for its hymns to and its mortuary texts. The oldest extant Egyptian literature is the Pyramid Texts: the mythology and rituals carved around the tombs of rulers. The later, secular literature of ancient Egypt includes the 'wisdom texts', forms of philosophical instruction. The Instruction of Ptahhotep, for example, is a collation of moral proverbs by an Egto (the middle of the second millennium BC) seem to have been drawn from an elite administrative class, and were celebrated and revered into the New Kingdom (to the end of the second millennium). In time, the Pyramid Texts became Coffin Texts (perhaps after the end of the Old Kingdom), and finally, the mortuary literature produced its masterpiece, the Book of the Dead, during the New Kingdom.

				The Middle Kingdom was the golden age of Egyptian literature. Some notable texts include the Tale of Neferty, the Instructions of Amenemhat I, the Tale of Sinuhe, the Story of the Shipwrecked Sailor and the Story of the Eloquent Peasant. Instructions became a popular literary genre of the New Kingdom, taking the form of advice on proper behavior. The Story of Wenamun and the Instruction of Any are well-known examples from this period.

				During the Greco-Roman period (332 BC − AD 639), Egyptian literature was translated into other languages, and Greco-Roman literature fused with native art into a new style of writing. From this period comes the Rosetta Stone, which became the key to unlocking the mysteries of Egyptian writing to modern scholarship. The great city of Alexandria boasted its famous Library of almost half a million handwritten books during the third century BC. Alexandria's center of learning also produced the Greek translation of the Hebrew Bible, the Septuagint.
			</p>
			</div>
				</div>
			<div class="col-lg-6">
				<div class="Image_Box">
				<img src="<?php echo $images.'/about/3.jpg'?>">
			</div>
				</div>
			<div class="col-lg-12">
				<p></p>
			</div>
		</div>
		</div>
	</section>
		<!-- End About Type Section -->
			<!-- Start About Egypt Section -->
	<section id="Religious" class="Details">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 ">
		<div class="Details_Box" >
			<h2>Religious</h2>
			<p>
			Since antiquity, Egypt has been a center for religious thought. Although it has long since passed into the annals of history, the religion of the Pharaohs was fiercely defended by its priests against outside invaders again and again. In the Christian era, the bishops of Alexandria were constantly on the guard against heresy, and the institution of monasticism owes much to Egyptian contributions. Since Islam arrived in the 7th century C.E., Egypt has been home to many reputed scholars, like the Imam Shaf'i, whose legal rulings are still used to this day. Egypt is also the home to Al Azhar University, one of the oldest and most respected institutions of Islamic education in the entire world.

			It should come as no surprise that religion still plays a vital role in Egyptian society.
			</p>
			</div>
				</div>
			<div class="col-lg-6">
				<div class="Image_Box">
			<img src="<?php echo $images.'/about/4.jpg'?>">
			</div>
				</div>
			<div class="col-lg-12">
				<p>About 90% of Egypt's population is Muslim, with a Sunni majority. About 9% of the population is Coptic Christian; other religions and other forms of Christianity comprise the remaining one percent,Religion pervades many other aspects of life in Egypt</p>
			</div>
		</div>
		</div>
	</section>
		<!-- End About Type Section -->
</html>
<?php include $tpl . 'footer.php'; ?>
