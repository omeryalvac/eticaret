﻿<?php include 'header.php'; ?>

	<div class="container">
		
		<div class="clearfix"></div>
		<div class="lines"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
			</div>
		</div>
		<div class="title-bg">
			<div class="title">Ödeme Sayfası</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered chart">
				<thead>
					<tr>
						<th>Remove</th>
						<th>Ürün Resmi</th>
						<th>Ürün Adı</th>
						<th>Ürün Kodu</th>
						<th>Adet</th>
						<th>Toplam Fiyat</th>
					</tr>
				</thead>
				<tbody>

				 <?php 
				 $kullanici_id=$kullanicicek['kullanici_id'];
				 $sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
				 $sepetsor->execute(array(
				   'id' => $kullanici_id
				 ));
				 
				 
				 while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) { 

				 $urun_id=$sepetcek['urun_id'];

                   $urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
                   $urunsor->execute(array(
	               'urun_id' => $urun_id
	                  ));

				   $uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
				   $toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
				   
				   ?>



					<tr>
						<td><input type="checkbox"></form></td>
						<td><img src="images\demo-img.jpg" width="100" alt=""></td>
						<td><?php echo $uruncek['urun_ad'] ?></td>
						<td><?php echo $uruncek['urun_id'] ?></td>
						<td><form><?php echo $sepetcek['urun_adet'] ?> </form></td>
						<td><?php echo $uruncek['urun_fiyat'] ?></td>
						
					</tr>
					
				 <?php } ?>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">
				
				
			</div>
			<div class="col-md-3 col-md-offset-3">
			<div class="subtotal-wrap">
				<div class="subtotal">
				<!--	<p>Toplam Fiyat : $26.00</p>
					<p>Vat 17% : $54.00</p>
				</div> -->
				<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo $toplam_fiyat ?> TL</span></div>
			
				<div class="clearfix"></div>
				<!--<a href="" class="btn btn-default btn-yellow">Ödeme Sayfası</a>-->
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
        <div class="tab-review">
				<ul id="myTab" class="nav nav-tabs shop-tab">
					
					<li class="active"><a href="#desc" data-toggle="tab">Kredi Kartı</a></li>
					<li><a href="#rev" data-toggle="tab">Banka Havalesi</a></li>
					
				</ul>

						<div id="myTabContent" class="tab-content shop-tab-ct">

							<div class="tab-pane fade active in" id="desc">
								<p>
									Entegrasyon Tamamlanmadı.
								</p>
							</div>


							<div class="tab-pane fade " id="rev">

							<form action="admin/netting/islem.php" method="POST">
								<p>Ödeme Yapacağınız Hesap No Seçin</p>

								<?php
							$bankasor=$db->prepare("SELECT * FROM banka order by banka_id ASC");
							$bankasor->execute();

							while($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)){ ?>
							
              <input type="radio" name="banka_id" value="<?php echo $bankacek['banka_id']	?>" >
							<?php echo $bankacek['banka_ad']; echo " ";	?><br>
                      
							<?php	} ?>
							<hr>
							<button class="btn btn-success" type="submit" name="sipariskaydet"> Sipariş Ver  </button>
							</form>
					    </div>							
				</div>
			</div>

			<div id="title-bg">
				<div class="title">Benzer Ürünler</div>
			</div>
			<div class="row prdct"><!--Products-->
				

				<?php 

				$kategori_id=$uruncek['kategori_id'];

				$urunaltsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by  rand() limit 3");
				$urunaltsor->execute(array(
					'kategori_id' => $kategori_id
					));

				while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {
					
					?>

					<div class="col-md-4">
						<div class="productwrap">
							<div class="pr-img">
								<div class="hot"></div>
								<a href="urun-<?=seo($urunaltcek["urun_ad"]).'-'.$urunaltcek["urun_id"]?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
								<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $urunaltcek['urun_fiyat']*1.50 ?> TL</span><?php echo $urunaltcek['urun_fiyat'] ?> TL</span></div></div>
							</div>
							<span class="smalltitle"><a href="product.htm"><?php echo $urunaltcek['urun_ad'] ?></a></span>
							<span class="smalldesc">Ürün Kodu.: <?php echo $urunaltcek['urun_id'] ?></span>
						</div>
					</div>
                    <?php } ?>
		<div class="spacer"></div>
	</div>
	
	<?php include 'footer.php' ?>