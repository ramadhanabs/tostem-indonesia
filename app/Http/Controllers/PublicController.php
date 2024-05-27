<?php

namespace App\Http\Controllers;

use App\Http\Response\PublicResponse;
use App\Product;
use App\Project;
use App\Blog;
use App\Contacts;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    use ThemeAndViews, RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('public');
    }

    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $page = app(\Litecms\Page\Interfaces\PageRepositoryInterface::class)->getPage('home');
        $urlSegment = request()->segments();
        if ($urlSegment[0] == "id") {
            $seoDesc = "Rencanakan hunian impian anda menggunakan produk Tostem LIXIL Aluminium Indonesia. Kami memiliki produk pintu dan jendela model terbaru berbahan aluminium.";
            $seoTitle = "Tostem LIXIL Aluminium Indonesia";
        } else {
            $seoDesc = "Plan your dream home using products from Tostem LIXIL Aluminum Indonesia. We have the latest model of aluminum doors and windows. Find out here.";
            $seoTitle = "Tostem LIXIL Aluminium Indonesia";
        }
        return $this->response
            ->setMetaKeyword("Tostem Indonesia")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('home')
            ->data(compact('page'))
            ->output();
    }

    public function brand()
    {
        $urlSegment = request()->segments();
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        if ($urlSegment[0] == "id") {
            $seoDesc = "Begini perjalanan tostem dalam mengembangkan inovasi untuk memberikan kenyamanan dan keamanan pada hunian rumah Anda. Kenali kami lebih dekat disini.";
            $seoTitle = "Mengenal Tentang Brand Tostem";
        } else {
            $seoDesc = "This is the journey of Tostem in developing innovations to provide comfort and safety to your home. Get to know us more closely here.";
            $seoTitle = "Get To Know About The Tostem Brand";
        }

        return $this->response
            ->setMetaKeyword("brand, tostem indonesia")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('brand')
            ->output();
    }


    public function references()
    {
        $reference = DB::table('projects')->get();
        $refCategory = DB::table('references_category')->get();

        return $this->response
            ->setMetaKeyword("Reference")
            ->setMetaDescription("Reference")
            ->setMetaTitle("Reference")
            ->layout('front_page')
            ->view('references')
            ->data(['reference'=>$reference,'refCategory'=>$refCategory])
            ->output();
    }

    public function termandcondition()
    {
        return $this->response
            ->setMetaKeyword("Privacy Notice")
            ->setMetaDescription("Privacy Notice")
            ->setMetaTitle("Privacy Notice")
            ->layout('front_page')
            ->view('termsandcondition')
            // ->data(['reference'=>$reference,'refCategory'=>$refCategory])
            ->output();
    }

    public function productsType()
    {
        $urlSegment = request()->segments();

        if ($urlSegment[0] == "id") {
            $seoDesc = "Produk Tostem dibuat dan didesain dengan proses sangat detail untuk menghasilkan produk pintu dan jendela aluminium kualitas terbaik. Cek produknya disini";
            $seoTitle = "Model Produk Pintu dan Jendela - Tostem Indonesia";
        } else {
            $seoDesc = "Tostem products are made and designed with a very detailed process to produce the best quality aluminum doors and windows products. Check the product here";
            $seoTitle = "Doors and Windows Product - Tostem Indonesia";
        }

        return $this->response
            ->setMetaKeyword("Products Type")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('products_type')
            ->output();
    }

    public function productsTypeOverview($locale,$product_operation='')
    {
        $productoperation = preg_replace('/[.,\/#!$%\^&\*;:{}=\-_`~()]/', ' ', $product_operation);
        $urlSegment = request()->segments();

        if ($urlSegment[0] == "en") {
            $products = Product::where('operation', $productoperation);
            $products = $products->get();

            if ($productoperation == "awning door") {
                $seoTitle = "Tostem Lixil Best Aluminum Doors No.1";
                $seoDesc = "Bored with the usual house door models? Install your door with the latest best model aluminum doors with premium materials from Tostem Lixil.";

            } else if ($productoperation == "awning window") {

                $seoTitle = "Aluminum Window Awnings - Tostem Indonesia";
                $seoDesc = "Did you know, Tostem comes with window awning products with various models and the best aluminum in its class. Check out some of the models here.";
            } else if ($productoperation == "casement window") {

                $seoTitle = "Aluminum Casement Window - Tostem Indonesia";
                $seoDesc = "Are you looking for a quality aluminum casement window? Tostem now comes with the best and cheap casement window products in Indonesia. Look here.";
            } else if ($productoperation == "fixed window") {

                $seoTitle = "Fixed Aluminum Window - Tostem Indonesia";
                $seoDesc = "Tostem comes with fixed window products with various models and the best aluminum in its class. Check out some of the models here.";
            } else if ($productoperation == "sliding window") {

                $seoTitle = "Aluminum Sliding Window - Tostem Indonesia";
                $seoDesc = "Are you looking for inspiration for a sliding window model for your home? Tostem has a choice of aluminum sliding windows that suit your taste, check here.";
            } else if ($productoperation == "sliding door") {

                $seoTitle = "Best Aluminum Sliding Door - Tostem Indonesia";
                $seoDesc = "Have you ever seen a sliding door model made of aluminum? Now Tostem has a variety of the best aluminum sliding door models. Check here.";
            } else if ($productoperation == "swing door") {

                $seoTitle = "Best Aluminum Swing Door - Tostem Indonesia";
                $seoDesc = "This swing door is indeed the most commonly used door. But what if the aluminum swing door from Tostem is used? Very elegant, check here.";
            } else if ($productoperation == "swing window") {

                $seoTitle = "Aluminum Swing Window - Tostem Indonesia";
                $seoDesc = "Tostem has swing window products with various models and the best aluminum materials. It must be suitable to be implemented in your home.";
            } else if ($productoperation == "combination") {

                $seoTitle = "Aluminum Combination Window - Tostem Indonesia";
                $seoDesc = "Looking for a quality aluminum combination window? Tostem now comes with the best and cheap casement window products in Indonesia. Look here.";
            } else if ($productoperation == "ventilation") {

                $seoTitle = "Aluminum Ventilation Window - Tostem Indonesia";
                $seoDesc = "Tostem has ventilation window products with various models and the best aluminum materials. It must be suitable to be implemented in your home.";
            } else if ($productoperation == "airflow system") {

                $seoTitle = "The Best Aluminum Airflow Door System - Tostem Indonesia";
                $seoDesc = "The choice of doors with the Air Flow system is perfect for those of you who want good home air circulation. See the product here.";
            } else if ($productoperation == "partition door") {

                $seoTitle = "Best Aluminum Partition Door - Tostem Indonesia";
                $seoDesc = "Now, Tostem comes with a partition door that functions as a divider between rooms. Choose a model that suits your room concept here.";
            } else if ($productoperation == "hanging door") {

                $seoTitle = "Best Aluminum Hanging Door - Tostem Indonesia";
                $seoDesc = "A wide selection of the best quality hanging door models is only available at Tostem. See detailed material specifications and materials here.";
            } else if ($productoperation == "louver") {

                $seoTitle = "Produk Grants - Tostem Indonesia";
                $seoDesc = "Produk Grants seri andalan dari Tostem. Desain yg inovatif, permukaan kaca yg lebih besar dan juga terbuat dari bahan aluminium terbaik. Cek disini.";
            } else if ($productoperation == "folding door") {
                $seoTitle = "";
                $seoDesc = "";
            } else if ($productoperation == "folding window") {
                $seoTitle = "Aluminum Folding Window - Tostem Indonesia";
                $seoDesc = "Tostem now comes with folding window products to add a beauty to your home. Check out some of the models here.";
            } else {
                $seoTitle = "";
                $seoDesc = "";
            }

        } else {
            $products = Product::where('operationID', $productoperation);
            $products = $products->get();

            if ($productoperation == "pintu awning") {
                $seoTitle = "Tostem Lixil Best Aluminum Doors No.1";
                $seoDesc = "Bored with the usual house door models? Install your door with the latest best model aluminum doors with premium materials from Tostem Lixil.";

            } else if ($productoperation == "jendela awning") {

                $seoTitle = "Tostem Jendela Awning Aluminium Terbaik dan Termurah";
                $seoDesc = "Did you know, Tostem comes with window awning products with various models and the best aluminum in its class. Check out some of the models here.";
            } else if ($productoperation == "jendela casement") {

                $seoTitle = "Tostem Jendela Awning Aluminium Terbaik dan Termurah";
                $seoDesc = "Tahukah anda, Tostem hadir dengan produk jendela awning dengan berbagai model dan bahan aluminium terbaik dikelasnya. Lihat beberapa modelnya disini.";
            } else if ($productoperation == "jendela fixed") {

                $seoTitle = "Tostem Jendela Fixed Aluminium Terbaik dan Termurah";
                $seoDesc = "Tostem hadir dengan produk jendela fixed dengan berbagai model dan bahan aluminium terbaik dikelasnya. Lihat beberapa modelnya disini.";
            } else if ($productoperation == "jendela sliding") {

                $seoTitle = "Tostem Jendela Geser Aluminium Minimalis Termurah";
                $seoDesc = "Anda sedang mencari inspirasi model jendela geser untuk rumah Anda? Tostem punya pilihan jendela geser aluminium yang sesuai selera anda cek disini.";
            } else if ($productoperation == "pintu sliding") {

                $seoTitle = "Tostem Pintu Geser Aluminium Terbaik";
                $seoDesc = "Sudah pernah lihat belum model pintu geser atau sliding door berbahan aluminium ? Kini Tostem memiliki model pintu geser aluminium yang keren. Cek disini.";
            } else if ($productoperation == "pintu swing") {

                $seoTitle = "Tostem Pintu Swing Aluminium Terbaik";
                $seoDesc = "Pintu swing ini memang pintu yang paling umum digunakan. Tapi bagaimana jika yang digunakan pintu swing aluminium dari Tostem? Elegan bgt cek disini.";
            } else if ($productoperation == "jendela swing") {

                $seoTitle = "Tostem Jendela Swing Aluminium Minimalis Termurah";
                $seoDesc = "Tostem memiliki produk jendela swing dengan berbagai model dan bahan aluminium terbaik loh. Pasti cocok untuk diimplementasikan pada rumah anda.";
            } else if ($productoperation == "kombinasi") {

                $seoTitle = "Tostem Jendela Combination Aluminium Minimalis Termurah";
                $seoDesc = "Sedang cari jendela kombinasi aluminium yang berkualitas ? Tostem kini hadir dengan produk jendela casement murah dan terbaik se-indonesia. Lihat disini.";
            } else if ($productoperation == "ventilasi") {

                $seoTitle = "Tostem Jendela Ventilation Aluminium Minimalis Termurah";
                $seoDesc = "Tostem memiliki produk jendela ventilasi dengan berbagai model dan bahan aluminium terbaik loh. Pasti cocok untuk diimplementasikan pada rumah anda.";
            } else if ($productoperation == "airflow system") {

                $seoTitle = "Tostem Pintu Dengan System Airflow Aluminium Terbaik";
                $seoDesc = "Pilihan pintu dengan sistem Air Flow sangat cocok digunakan untuk Anda yang menginginkan sirkulasi udara rumah yang baik. Lihat produknya disini.";
            } else if ($productoperation == "pintu partisi") {

                $seoTitle = "Tostem Pintu Partisi Aluminium Terbaik";
                $seoDesc = "Kini tostem hadir dengan pintu partisi yang berfungsi sebagai penyekat antar ruangan. Pilih model yang sesuai dengan konsep ruangan anda disini.";
            } else if ($productoperation == "pintu hanging") {

                $seoTitle = "Tostem Pintu Hanging Aluminium Terbaik";
                $seoDesc = "Berbagai macam pilihan model pintu hanging berkualitas terbaik hanya ada di Tostem. Lihat spesifikasi dan material bahan secara detail disini.";
            } else if ($productoperation == "louver") {

                $seoTitle = "";
                $seoDesc = "";
            } else if ($productoperation == "pintu folding") {
                $seoTitle = "";
                $seoDesc = "";
            } else if ($productoperation == "jendela folding") {
                $seoTitle = "Aluminum Folding Window - Tostem Indonesia";
                $seoDesc = "Tostem now comes with folding window products to add a beauty to your home. Check out some of the models here.";
            } else {
                $seoTitle = "";
                $seoDesc = "";
            }
        }

        if (count($products) == 0) {
            if ($urlSegment[0] == "en") {
                $products = Product::where('category', $productoperation);
                $products = $products->get();

                if ($productoperation == "door") {
                    $seoTitle = "Tostem Lixil Best Aluminum Doors No.1";
                    $seoDesc = "Bored with the usual house door models? Install your door with the latest best model aluminum doors with premium materials from Tostem Lixil.";

                } else if ($productoperation == "windows") {

                    $seoTitle = "Tostem Lixil Best and Cheapest Aluminum Window";
                    $seoDesc = "Looking for quality window sills? The best aluminum window system in its class. Besides the cheap price, the quality is no doubt check here.";
                } 

            } else {
                $products = Product::where('categoryID', $productoperation);
                $products = $products->get();

                if ($productoperation == "pintu") {
                    $seoTitle = "Tostem Lixil Pintu Aluminium Premium Terbaik No.1";
                    $seoDesc = "Bosen dengan model pintu rumah yang biasa aja ? Pasang pintu anda dengan pintu aluminium terbaik model terbaru dengan bahan premium dari Tostem Lixil.";

                } else if ($productoperation == "jendela") {

                    $seoTitle = "Tostem Lixil Jendela Aluminium Terbaik dan Termurah";
                    $seoDesc = "Cari kusen jendela rumah yang berkualitas ? Tostem jendela aluminium terbaik dikelasnya. Selain harganya murah, kualitasnya tidak diragukan cek disini.";
                } else {
                    $seoTitle = "";
                    $seoDesc = "";
                }
            }
        }

        return $this->response
            ->setMetaKeyword($productoperation)
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('product_type_overview')
            ->data(['product_type' => $productoperation, 'product_description' => 'loremipsumamet', 'products' => $products])
            ->output();
    }

    public function products()
    {
        $urlSegment = request()->segments();

        if ($urlSegment[0] == "id") {
            $seoDesc = "Produk Tostem dibuat dan didesain dengan proses sangat detail untuk menghasilkan produk pintu dan jendela aluminium kualitas terbaik. Cek produknya disini";
            $seoTitle = "Model Produk Pintu dan Jendela - Tostem Indonesia";
        } else {
            $seoDesc = "Tostem products are made and designed with a very detailed process to produce the best quality aluminum doors and windows products. Check the product here";
            $seoTitle = "Doors and Windows Product - Tostem Indonesia";
        }

        return $this->response
            ->setMetaKeyword("Products")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('products')
            ->output();
    }


    public function productsOverview($locale, $product_type)
    {
        $producttype = preg_replace('/[.,\/#!$%\^&\*;:{}=\-_`~()]/', ' ',$product_type);
        // print_r($product_type);die;
        $products = Product::where('type', $product_type);
        $performance = DB::table('master_type')->where('title_master_type', $producttype);
        $query_cat = [];
		$query_op = [];
		
		$i_cat= 0;
        for ($i = 1; $i <= 2; $i++) {
            if (isset($_GET['category' . $i])) {
                if ($_GET['category' . $i] != "") {
				array_push($query_cat, $_GET['category' . $i]);
               }
            }
        }

		$urlSegment = request()->segments();
		
		if(count($query_cat)>0){
		
		$products = $products->where(function($query) use ($query_cat,$i_cat) {
		$urlSegment = request()->segments();
		for ($i = 0; $i < count($query_cat); $i++) {
		
				if($i_cat==0){
                    if ($urlSegment[0] == "en") {
                        $query = $query->where('category', $query_cat[0]);
                    } else {
                        $query = $query->where('categoryID', $query_cat[0]);
                    }
					$i_cat=$i_cat+1;	
				}
				else{
                    if ($urlSegment[0] == "en") {
                        $query = $query->orwhere('category', $query_cat[0]);
                    } else {
                        $query = $query->orwhere('categoryID', $query_cat[0]);
                    }
				}
		}
		}
		);
		}
		
		
		for ($i = 1; $i <= 8; $i++) {
            if (isset($_GET['operation' . $i])) {
                if ($_GET['operation' . $i] != "") {
					array_push($query_op, $_GET['operation' . $i]);
               }
            }
        }
		
		

		$i_op =0;
		if(count($query_op)>0){
		$products = $products->where(function($query) use ($query_op,$i_op) {
		
        for ($i = 0; $i < count($query_op); $i++) {
				if($i_op==0){
                    if ($urlSegment[0] == "en") {
                        $query = $query->where('operation', $query_op[$i] );
                    } else {
                        $query = $query->where('operationID', $query_op[$i] );
                    }
					$i_op=$i_op+1;	
				}
				else{
                    if ($urlSegment[0] == "en") {
                        $query = $query->orwhere('operation', $query_op[$i] );
                    } else {
                        $query = $query->orwhere('operationID', $query_op[$i] );
                    }
				}
        
		}});
		}
		
		

        $products = $products->get();
        $performance = $performance->first();
        // print_r($producttype);die;
        // $urlSegment = request()->segments();

        if ($urlSegment[0] == "id") {
            if ($product_type == "ez") {
                $seoTitle = "Produk EZ - Tostem Indonesia";
                $seoDesc = "Produk Model E'Z ini sering digunakan untuk bagian depan toko atau bangunan komersial. Memberikan keindahan dengan desain yang elegan. Cek disini.";
            } else if ($product_type == "grants") {
                $seoTitle = "Produk Grants - Tostem Indonesia";
                $seoDesc = "Produk Grants seri andalan dari Tostem. Desain yg inovatif, permukaan kaca yg lebih besar dan juga terbuat dari bahan aluminium terbaik. Cek disini.";
            } else if ($product_type == "giesta") {
                $seoTitle = "Produk Giesta - Tostem Indonesia";
                $seoDesc = "Produk Giesta ini merupakan pintu bermotif kayu dan metalik berkualitas tinggi, disertai kunci keamanan terbaik. Cocok untuk rumah anda, lihat disini.";
            } else if ($product_type == "we-plus") {
                $seoTitle = "Produk We Plus - Tostem Indonesia";
                $seoDesc = "Produk WE Plus tersedia dalam berbagai desain yang elegan dengan ketinggian maksimal 3m untuk memenuhi keutuhan anda. Lihat produknya disini.";
            } else if ($product_type == "we-40") {
                $seoTitle = "Produk We 40 - Tostem Indonesia";
                $seoDesc = "Produk WE 40 menghadirkan kualitas Tostem dalam kehidupan sehari-hari. Dibuat atas permintaan pasar saat ini. Cocok untuk rumah anda, cek disini.";
            } else if ($product_type == "we-70") {
                $seoTitle = "Produk We 70 - Tostem Indonesia";
                $seoDesc = "Produk WE 70 Dibuat atas permintaan pasar saat ini. Dengan kualitas standar Tostem dan juga harga yang sangat terjangkau. Cocok untuk rumah anda, cek disini.";
            } else if ($product_type == "view-and-view-plus") {
                $seoTitle = "Produk View Plus Tostem Indonesia";
                $seoDesc = "Produk View Plus standar kualitas jepang JIS. Dengan kaca ketebalan 28mm membuat anda merasa nyaman, menenangkan pikiran sambil menikmati pemandangan luar.";
            } else if ($product_type == "interior") {
                $seoTitle = "Produk Interior Series - Tostem Indonesia";
                $seoDesc = "Produk ini biasanya berfungsi sebagai pembagi ruangan. Desainnya yang mewah, tersedia beberapa tipe seperti track lantai, sliding, dan swing. Cek disini";
            } else if ($product_type == "matsu") {
                $seoTitle = "Produk Matsu - Tostem Indonesia";
                $seoDesc = "Produk ini dirancang dengan sparepart asli dari Tostem. Matsu dapat terhubung dengan jendela dan pintu dalam View Series. Cek produknya disini.";
            } else if ($product_type == "atis") {
                $seoTitle = "Produk Atis - Tostem Indonesia";
                $seoDesc = "ATIS merupakan inovasi terbaru dari TOSTEM. Selain berwujud estetis, terdapat teknologi dan inovasi yang sudah dipatenkan di dalamnya. Diciptakan dengan desain yang artistik dan minimal untuk membangun bingkai foto pada dinding, kami ingin Anda merasakan pengalaman keindahan hidup. ATIS bukan hanya sekadar bingkai jendela dan pintu, namun sebuah karya seni yang bergerak.";
            }
        } else {
            if ($product_type == "ez") {
                $seoTitle = "EZ Products - Tostem Indonesia";
                $seoDesc = "E'Z products are often used for shop fronts or commercial buildings. Provides beauty with an elegant design. Check here.";
            } else if ($product_type == "grants") {
                $seoTitle = "Grants Series - Tostem Indonesia";
                $seoDesc = "Tostem's flagship series Grants product. Innovative design, bigger glass surface and also made of the best aluminum. Check here.";
            } else if ($product_type == "giesta") {
                $seoTitle = "Giesta Series - Tostem Indonesia";
                $seoDesc = "This Giesta product is a high quality wood and metallic patterned door, accompanied by the best security lock. Suitable for your home, see here.";
            } else if ($product_type == "we-plus") {
                $seoTitle = "We Plus Series - Tostem Indonesia";
                $seoDesc = "The WE Plus products are available in a variety of elegant designs with a maximum height of 3m to suit your needs. See the product here.";
            } else if ($product_type == "we-40") {
                $seoTitle = "We 40 Series - Tostem Indonesia";
                $seoDesc = "The WE 40 product brings Tostem quality to everyday life. Made on current market demand. Suitable for your home, check here.";
            } else if ($product_type == "we-70") {
                $seoTitle = "We 70 Series - Tostem Indonesia";
                $seoDesc = "Product WE 70 Made according to today's market demand. With Tostem standard quality and also a very affordable price. Suitable for your home, check here.";
            } else if ($product_type == "view-and-view-plus") {
                $seoTitle = "View Plus Series - Tostem Indonesia";
                $seoDesc = "View Plus products are JIS Japanese quality standards. With 28mm thickness glass makes you feel comfortable, calm your mind while enjoying the outside view.";
            } else if ($product_type == "interior") {
                $seoTitle = "Interior Series - Tostem Indonesia";
                $seoDesc = "This product usually functions as a room divider. The design is luxurious, there are several types, such as floor track, sliding and swing. Check here";
            } else if ($product_type == "matsu") {
                $seoTitle = "Matsu Products - Tostem Indonesia";
                $seoDesc = "This product is designed with original spare parts from Tostem. Matsu can connect with windows and doors in the View Series. Check the product here.";
            } else if ($product_type == "atis") {
                $seoTitle = "Produk Atis - Tostem Indonesia";
                $seoDesc = "ATIS is the latest innovation from TOSTEM. Apart from being aesthetically pleasing, there are patented technologies and innovations in it. Created with an artistic and minimal design to build a photo frame on the wall, we want you to experience the beauty of life. ATIS is not just a window and door frame, it is a work of art that moves.";
            }
        }


        
        return $this->response
            ->setMetaKeyword($product_type)
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('products_overview')
            ->data(['product_type' => $product_type, 'product_description' => 'loremipsumamet', 'products' => $products, 'performance' => $performance])
            ->output();
    }





    public function productsDetail($locale,$id_product, $product_url)
    {
        $product = Product::where('url_products',$product_url)->where('id',$id_product)->first();
        // $product = Product::where('name',$this->remove_slug($product_url))->first();
        $performance = DB::table('master_type')->where('title_master_type', $product->type)->first();
        return $this->response
            ->setMetaKeyword($product_url)
            ->setMetaDescription($product_url)
            ->setMetaTitle($product->name)
            ->layout('front_page')
            ->view('products_detail')
            ->data(['product_type' => $product->name, 'product_description' => '', 'product' => $product, 'performance'=>$performance])
            ->output();
      
    }

    public function referenceSingle($slug,$urlref)
    {   
        $projects = DB::table('projects')->where('url_name', $urlref)->first();
        return $this->response
            ->setMetaKeyword($projects->name)
            ->setMetaDescription($projects->content)
            ->setMetaTitle('Reference - '.$projects->name)
            ->layout('front_page')
            ->view('reference_single')
            ->data(['projects'=>$projects])
            ->output();
    }


    public function whatsOn()
    {
        $urlSegment = request()->segments();

        if ($urlSegment[0] == "id") {
            $seoDesc = "Kumpulan artikel dan informasi penting seputar tips hunian idaman rumah maupun untuk kantor yang diringkas secara ringan dan menarik. Baca disini.";
            $seoTitle = "Artikel Blog Tostem Indonesia";
            $idLang = 1;
        } else {
            $seoDesc = "A collection of articles and important information about tips for ideal housing for homes and offices, which are summarized lightly and attractively. Read here.";
            $seoTitle = "Blog Articles - Tostem Indonesia";
            $idLang = 2;
        }

        $blog = Blog::where('id_lang',$idLang)->orderBy('id','desc')->get();
        return $this->response
            ->setMetaKeyword("Whats On")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('whats_on')
            ->data(['blogs'=> $blog])
            ->output();
    }

    public function whatsOnSingle($locale,$idBLog,$slug)
    {
        $blog = Blog::where('slug',$slug)->where('id',$idBLog)->first();
        // $segment = request()->segments();
        // $url = '';

        // foreach ($segment as $key => $value) {
        //     if ($segment[$key] == 'en') {
        //         $url .= '/id';
        //     } else {
        //         $url .= '/'.$value;
        //     }
        // }
        // if ($segment[0] == 'en') {
        //     return redirect($url);
        // }
	   return $this->response
            ->setMetaKeyword($blog['description'])
            ->setMetaDescription($blog['meta_recomendation'])
            ->setMetaTitle($blog['title'])
            ->layout('front_page')
            ->view('whats_on_single')
            ->data(['blog'=> $blog,'langurl'=>'no'])
            ->output();
     
    }


    public function faq()
    {

        $urlSegment = request()->segments();
        
        if ($urlSegment[0] == "id") {
            $seoDesc ="Anda tertarik dengan produk kami ? Lihat beberapa pertanyaan yang sering diajukan oleh calon konsumen kami. Lihat jawabannya, cek disini";
            $seoTitle = "FAQ - Tostem Indonesia";
        } else {
            $seoDesc = "Are you interested in our product? Check out some of the questions that are frequently asked by our potential customers. See the answer, check here";
            $seoTitle = "FAQ - Tostem Indonesia";
        }


        return $this->response
            ->setMetaKeyword("FAQ")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('faq')
            ->output();
    }


    public function tos()
    {
        return $this->response
            ->setMetaKeyword("Term of Use")
            ->setMetaDescription("Term of Use")
            ->setMetaTitle("Term of Use")
            ->layout('front_page')
            ->view('tos')
            ->output();
    }


    public function airFlow()
    {

        $urlSegment = request()->segments();
        
        if ($urlSegment[0] == "id") {
            $seoDesc ="Tahukah anda, rumah dengan ventilasi yang bagus dapat mengurasi kontaminasi udara seperti virus termasuk Covid-19 ini loh. Produk Tostem solusinya.";
            $seoTitle = "Sistem AirFlow dan COVID-19";
        } else {
            $seoDesc = "Did you know, a house with good ventilation can reduce air contamination such as viruses, including Covid-19. The Tostem product is the solution.";
            $seoTitle = "AirFlow System and COVID-19";
        }


        return $this->response
            ->setMetaKeyword("Delivery")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('delivery')
            ->output();
    }


    public function catalogue()
    {
        $urlSegment = request()->segments();
        
        if ($urlSegment[0] == "id") {
            $seoDesc ="Banyak sekali produk dan model jenis pintu dan jendela aluminium yang bisa anda lihat pada katalog produk kami. Lihat dan temukan produk yang anda sukai.";
            $seoTitle = "Katalog Produk - Tostem Indonesia";
        } else {
            $seoDesc = "There are so many products and models of aluminum doors and windows that you can see in our product catalog. Look and find the product you like.";
            $seoTitle = "Product Catalog - Tostem Indonesia";
        }

        return $this->response
            ->setMetaKeyword("Catalogue")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('catalogue')
            ->output();
    }




    public function career()
    {
        $urlSegment = request()->segments();
        
        if ($urlSegment[0] == "id") {
            $seoDesc ="Apakah anda salah satu yang memiliki talenta dan passion di bidang 'Home Living' ? Mari bergabung dan berkembang bersama kami di Tostem Indonesia.";
            $seoTitle = "Bergabung Bersama Kami - Tostem Indonesia";
        } else {
            $seoDesc = "Are you one of those who has talent and passion in the field of 'Home Living'? Let's join and grow with us at Tostem Indonesia.";
            $seoTitle = "Bergabung Bersama Kami - Tostem Indonesia";
        }

        return $this->response
            ->setMetaKeyword("Career")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('career')
            ->output();
    }


    public function underConstruction()
    {
        return $this->response
            ->setMetaKeyword("Under Contruction")
            ->setMetaDescription("Under Contruction")
            ->setMetaTitle("Under Contruction")
            ->layout('front_page')
            ->view('under_construction')
            ->output();
    }

    public function virtualTour()
    {
        return $this->response
            ->setMetaKeyword("Tostem Virtual Showroom")
            ->setMetaDescription("Selamat datang area Virtual Showroom Tostem Lixil. Lihat model terbaik dari produk kami seperti pintu dan jendela aluminium kami secara langsung disini")
            ->setMetaTitle("Virtual Show Room")
            ->layout('front_page')
            ->view('virtualroom')
            ->output();
    }

    public function virtualShow()
    {
        return $this->response
            ->setMetaKeyword("Tostem Virtual Showroom")
            ->setMetaDescription("Selamat datang area Virtual Showroom Tostem Lixil. Lihat model terbaik dari produk kami seperti pintu dan jendela aluminium kami secara langsung disini")
            ->setMetaTitle("Virtual Show Room")
            ->layout('front_page')
            ->view('virtualroom')
            ->output();
    }

    public function privacyPolicy()
    {
        return $this->response
            ->setMetaKeyword("Privacy Policy")
            ->setMetaDescription("Privacy Policy")
            ->setMetaTitle("Privacy Policy")
            ->layout('front_page')
            ->view('privacy_policy')
            ->output();
    }



    public function projectSolution()
    {
        $urlSegment = request()->segments();

        if ($urlSegment[0] == "id") {
            $seoDesc = "Anda membutuhkan konsultasi untuk hunian rumah anda atau untuk kantor bisnis anda ?  Diskusikan dengan kami, kami siap membantu Anda.";
            $seoTitle = "Project Solution - Tostem Indonesia";
        } else {
            $seoDesc = "You need a consultation for your home or for your business office? Discuss with us, we are ready to help you.";
            $seoTitle = "Project Solution - Tostem Indonesia";
        }

        return $this->response
            ->setMetaKeyword("Project Solution")
            ->setMetaDescription($seoDesc)
            ->setMetaTitle($seoTitle)
            ->layout('front_page')
            ->view('project_solution')
            ->output();
    }

    public function authPage()
    {
        return $this->response
            ->setMetaKeyword("Auth Sign In - Sign Up")
            ->setMetaDescription("Auth Sign In")
            ->setMetaTitle("Authentification")
            ->layout('front_page')
            ->view('auth_page')
            ->output();
    }


	private function create_slug($string){
   		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   		return $slug;
	 }


	private function remove_slug($string){
   		$slug=str_replace('-', ' ', $string);
   		return $slug;
	 }



    public function authSignUp()
    {
        return $this->response
            ->setMetaKeyword("")
            ->setMetaDescription("Auth Sign Up")
            ->setMetaTitle("Sign Up")
            ->layout('front_page')
            ->view('auth_sign_up')
            ->output();
    }

    public function siteMap()
    {
        return response()->view('sitemap')->header('Content-Type','text/xml');
    }

    public function robot()
    {
        return response()->view('robot')->header('Content-Type','text/plain');
    }

    public function giestaSimulation()
    {
        return $this->response
            ->setMetaKeyword("Giesta Simulation")
            ->setMetaDescription('')
            ->setMetaTitle('')
            ->layout('front_page')
            ->view('default')
            ->output();
    }

    public function framegiestaSimulation()
    {
        return $this->response
            ->setMetaKeyword("Giesta Simulation")
            ->setMetaDescription('')
            ->setMetaTitle('')
            ->layout('front_page')
            ->view('framegiesta')
            ->output();
    }

    public function maingiesta($value='')
    {
        return $this->response
            ->setMetaKeyword("Giesta Simulation")
            ->setMetaDescription('')
            ->setMetaTitle('')
            ->layout('front_page')
            ->view('main')
            ->output();
    }
    public function contactus($value='')
    {
        $urlSegment = request()->segments();
        $LangID = $urlSegment[0];
        return $this->response
            ->setMetaKeyword("Contact Us")
            ->setMetaDescription('Contact Us')
            ->setMetaTitle('Contact Us')
            ->layout('front_page')
            ->view('contactus')
            ->data(['langIDUrl'=> $LangID])
            ->output();
    }
    public function contactUsCreated(Request $request)
    {
        DB::table('contacts')->insert([
    		'name' => $_POST['name'],
    		'email' => $_POST['email'],
    		'service' => $_POST['service'],
    		'details' => $_POST['details'],
    		'created_at' => date('Y-m-d'),
    	]);
        $LangWeb = $request->langid;
        return redirect('/'.$LangWeb.'/contactus')->with(['success' => 'Message was Successful!']);
    }

    public function oem()
    {
        return $this->response
            ->setMetaKeyword("Kontribusi nyata dalam perkembangan industri otomotif di Indonesia")
            ->setMetaDescription('Kami telah memulai bisnis otomotif sebagai pemasok suku cadang khususnya roof rack sejak tahun 2018. Bisnis Pertama kami adalah sebagai pemasok untuk model Toyota Fortuner. Bisnis ini dimulai pada bulan Oktober tahun 2018, bekerja sama dengan PT. Itochu Indonesia. Kami menghadirkan produk yang berkualitas sesuai dengan standar mutu pelanggan.')
            ->setMetaTitle('OEM')
            ->layout('front_page')
            ->view('oem')
            ->output();
    }
}
