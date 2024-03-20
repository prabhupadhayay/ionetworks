<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the 
<head> section and everything up until 
	<div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package online_photography
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head> <?php  
	    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
	         $url = "https://";   
	    else  
	         $url = "http://";   
	    // Append the host(domain name, ip) to the URL.   
	    $url.= $_SERVER['HTTP_HOST'];   
	    
	    // Append the requested resource location to the URL   
	    $url.= $_SERVER['REQUEST_URI'];    

	  ?> <?php
		if ($url == 'https://io.hfcl.com/blog/wi-fi-6-a-growth-catalyst-for-smes/') 
		{
		   echo '<title>Wi-Fi 6 - A Growth Catalyst for SMEs | IO by HFCL</title>';
		   echo '<meta name="description" content="Wireless high speed internet connectivity is becoming a crucial part of any SMEs. With the upcoming Wi-Fi- 6, lets see how it will help in the growth of these segments.">';
		}
		elseif ($url == 'https://io.hfcl.com/blog/5ghz-and-5g-resolving-namesake-crisis/') 
		{
		   echo '<title>5GHz and 5G - Resolving Namesake Crisis | IO by HFCL</title>
							<meta name="title" content="5GHz and 5G - Resolving Namesake Crisis | IO by HFCL" />
							<meta name="description" content="5G network is enabling a faster speed to meet customer needs. The difference and similarities between 5G and 5GHz will be helpful in understanding wireless connectivity."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/5ghz-and-5g-resolving-namesake-crisis/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="5GHz and 5G - Resolving Namesake Crisis | IO by HFCL" />
							<meta property="og:description" content="5G network is enabling a faster speed to meet customer needs. The difference and similarities between 5G and 5GHz will be helpful in understanding wireless connectivity."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/05/Banner_1920x1080.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="5GHz and 5G - Resolving Namesake Crisis | IO by HFCL" />
							<meta property="twitter:description" content="5G network is enabling a faster speed to meet customer needs. The difference and similarities between 5G and 5GHz will be helpful in understanding wireless connectivity."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/05/Banner_1920x1080.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/cloud-managed-wi-fi-its-importance/') 
		{
		   echo '<title>Cloud Managed Wi-Fi & Its Importance | IO by HFCL</title>
							<meta name="title" content="Cloud Managed Wi-Fi & Its Importance | IO by HFCL" />
							<meta name="description" content="The complexity of the network devices has been reduced with the utilization of cloud management. Know more about the advantages of cloud technology in wireless networks."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/cloud-managed-wi-fi-its-importance/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Cloud Managed Wi-Fi & Its Importance | IO by HFCL" />
							<meta property="og:description" content="The complexity of the network devices has been reduced with the utilization of cloud management. Know more about the advantages of cloud technology in wireless networks."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/cLoud-Managed-WiFi-2048x1152.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Cloud Managed Wi-Fi & Its Importance | IO by HFCL" />
							<meta property="twitter:description" content="The complexity of the network devices has been reduced with the utilization of cloud management. Know more about the advantages of cloud technology in wireless networks."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/cLoud-Managed-WiFi-2048x1152.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/digital-acceleration-for-a-better-tomorrow/') 
		{
		   echo '<title>Digital acceleration for better tomorrow | IO by HFCL</title>
							<meta name="title" content="Digital acceleration for better tomorrow | IO by HFCL" />
							<meta name="description" content="With the disruption in way of living due to the lockdown there has been a halt in the economy. The world is ready to adapt to the changes with the use of digitalization."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/digital-acceleration-for-a-better-tomorrow/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Digital acceleration for better tomorrow | IO by HFCL" />
							<meta property="og:description" content="With the disruption in way of living due to the lockdown there has been a halt in the economy. The world is ready to adapt to the changes with the use of digitalization."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/2-2048x1152.webp" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Digital acceleration for better tomorrow | IO by HFCL" />
							<meta property="twitter:description" content="With the disruption in way of living due to the lockdown there has been a halt in the economy. The world is ready to adapt to the changes with the use of digitalization."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/2-2048x1152.webp"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/a-quick-guide-to-different-types-of-ethernet-switches/') 
		{
		   echo '<title>A Quick Guide to Different Types of Ethernet Services | IO by HFCL</title>
						<meta name="title" content="A Quick Guide to Different Types of Ethernet Services | IO by HFCL" />
						<meta name="description" content="Explore the world of Ethernet services with IO by HFCLs quick guide. Learn about various types of Ethernet services, their benefits, and applications in this informative resource."/>
						<link rel="canonical" href="https://io.hfcl.com/blog/a-quick-guide-to-different-types-of-ethernet-switches/" />

						 <!-- Facebook Meta Tags -->
						<meta property="og:type" content="website" />
						<meta property="og:url" content="https://io.hfcl.com/" />
						<meta property="og:title" content="A Quick Guide to Different Types of Ethernet Services | IO by HFCL" />
						<meta property="og:description" content="Explore the world of Ethernet services with IO by HFCLs quick guide. Learn about various types of Ethernet services, their benefits, and applications in this informative resource."/>
						<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/switch-blog-banner_1920x1080-px.jpg" />

						 <!-- Twitter Meta Tags -->
						<meta property="twitter:card" content="summary_large_image" />
						<meta property="twitter:domain" content="io.hfcl.com/" />
						<meta property="twitter:url" content="https://io.hfcl.com/" />
						<meta property="twitter:title" content="A Quick Guide to Different Types of Ethernet Services | IO by HFCL" />
						<meta property="twitter:description" content="Explore the world of Ethernet services with IO by HFCLs quick guide. Learn about various types of Ethernet services, their benefits, and applications in this informative resource."/>
						<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/switch-blog-banner_1920x1080-px.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/the-growing-importance-of-ethernet-switches-in-industry/') 
		{
		   echo '<title>The Growing Importance of Ethernet switches | IO by HFCL</title>
							<meta name="title" content="The Growing Importance of Ethernet switches | IO by HFCL" />
							<meta name="description" content="Explore the rising significance of Ethernet switches in modern networking. Discover their crucial role in enhancing connectivity and optimizing data transfer for businesses today."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/the-growing-importance-of-ethernet-switches-in-industry/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="The Growing Importance of Ethernet switches | IO by HFCL" />
							<meta property="og:description" content="Explore the rising significance of Ethernet switches in modern networking. Discover their crucial role in enhancing connectivity and optimizing data transfer for businesses today."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/02/Ethernet-Switch-Blog-Banner-1.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="The Growing Importance of Ethernet switches | IO by HFCL" />
							<meta property="twitter:description" content="Explore the rising significance of Ethernet switches in modern networking. Discover their crucial role in enhancing connectivity and optimizing data transfer for businesses today."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/02/Ethernet-Switch-Blog-Banner-1.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/wi-fi-7-a-giant-leap-in-connected-future/') 
		{
		   echo '<title>Wi-Fi 7: A Giant Leap in Connected Future | IO by HFCL</title>
							<meta name="title" content="Wi-Fi 7: A Giant Leap in Connected Future | IO by HFCL" />
							<meta name="description" content="Discover Wi-Fi 7, the next giant leap in our connected future. Explore faster speeds, lower latency, and the future of wireless connectivity with Wi-Fi 7 technology."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/wi-fi-7-a-giant-leap-in-connected-future/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Wi-Fi 7: A Giant Leap in Connected Future | IO by HFCL" />
							<meta property="og:description" content="Discover Wi-Fi 7, the next giant leap in our connected future. Explore faster speeds, lower latency, and the future of wireless connectivity with Wi-Fi 7 technology."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2021/08/Wi-Fi-7.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Wi-Fi 7: A Giant Leap in Connected Future | IO by HFCL" />
							<meta property="twitter:description" content="Discover Wi-Fi 7, the next giant leap in our connected future. Explore faster speeds, lower latency, and the future of wireless connectivity with Wi-Fi 7 technology."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2021/08/Wi-Fi-7.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/wpa-3-security-ultra-secure-network/') 
		{
		   echo '<title>WPA 3 Security - Ultra Secure Network | IO by HFCL</title>
							<meta name="title" content="WPA 3 Security - Ultra Secure Network | IO by HFCL" />
							<meta name="description" content="Enhance your online security with WPA 3 - the ultimate in network protection. Discover the power of an ultra-secure network today!"/>
							<link rel="canonical" href="https://io.hfcl.com/blog/wpa-3-security-ultra-secure-network/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="WPA 3 Security - Ultra Secure Network | IO by HFCL" />
							<meta property="og:description" content="Enhance your online security with WPA 3 - the ultimate in network protection. Discover the power of an ultra-secure network today!"/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2021/08/WPA3-Security.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="WPA 3 Security - Ultra Secure Network | IO by HFCL" />
							<meta property="twitter:description" content="Enhance your online security with WPA 3 - the ultimate in network protection. Discover the power of an ultra-secure network today!"/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2021/08/WPA3-Security.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/bridging-digital-divide-in-baslambi-village/') 
		{
		   echo '<title>Bridging Digital divide in Baslambi Village | IO by HFCL</title>
							<meta name="title" content="Bridging Digital divide in Baslambi Village | IO by HFCL" />
							<meta name="description" content="IO by HFCL has brought opportunities in the village of Baslambi by serving them with wi-fi connection. Through this, the development of the village will take a pace. Read more."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/bridging-digital-divide-in-baslambi-village/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Bridging Digital divide in Baslambi Village | IO by HFCL" />
							<meta property="og:description" content="IO by HFCL has brought opportunities in the village of Baslambi by serving them with wi-fi connection. Through this, the development of the village will take a pace. Read more."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/Blog-Banner_Baslambi-village.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Bridging Digital divide in Baslambi Village | IO by HFCL" />
							<meta property="twitter:description" content="IO by HFCL has brought opportunities in the village of Baslambi by serving them with wi-fi connection. Through this, the development of the village will take a pace. Read more."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/03/Blog-Banner_Baslambi-village.jpg"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/mesh-network-and-iot/') 
		{
		   echo '<title>The Rise of the Internet of Things: Mesh Network as the Backbone of IoT</title>
							<meta name="title" content="The Rise of the Internet of Things: Mesh Network as the Backbone of IoT" />
							<meta name="description" content="Discover how mesh networks serves as the backbone of IoT in our comprehensive blog."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/mesh-network-and-iot/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="The Rise of the Internet of Things: Mesh Network as the Backbone of IoT" />
							<meta property="og:description" content="Discover how mesh networks serves as the backbone of IoT in our comprehensive blog."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/05/1-2048x1152.webp" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="The Rise of the Internet of Things: Mesh Network as the Backbone of IoT" />
							<meta property="twitter:description" content="Discover how mesh networks serves as the backbone of IoT in our comprehensive blog."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/05/1-2048x1152.webp"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/home-mesh-network-routers-in-entertainment/') 
		{
		   echo '<title>Streamlined Living: How Home Mesh Routers Simplify Your Entertainment Experience</title>
							<meta name="title" content="Streamlined Living: How Home Mesh Routers Simplify Your Entertainment Experience" />
							<meta name="description" content="Experience seamless connectivity with home mesh routers while enhancing your streaming and gaming experience."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/home-mesh-network-routers-in-entertainment/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Streamlined Living: How Home Mesh Routers Simplify Your Entertainment Experience" />
							<meta property="og:description" content="Experience seamless connectivity with home mesh routers while enhancing your streaming and gaming experience."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/06/1-03-1-2048x1152.png" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Streamlined Living: How Home Mesh Routers Simplify Your Entertainment Experience" />
							<meta property="twitter:description" content="Experience seamless connectivity with home mesh routers while enhancing your streaming and gaming experience."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/06/1-03-1-2048x1152.png"/>';
		}
		elseif ($url == 'https://io.hfcl.com/blog/wi-fi-marketing-a-stepping-stone-to-boost-your-business/') 
			{
		   echo '<title>Wi-Fi Marketing: A Stepping Stone to Boost Your Business</title>
							<meta name="title" content="Wi-Fi Marketing: A Stepping Stone to Boost Your Business" />
							<meta name="description" content="Discover the Power of Wi-Fi Marketing for Your Business Growth. Unlock New Opportunities and Connect with Customers. Explore Wi-Fi Marketing Solutions Today!"/>
							<link rel="canonical" href="https://io.hfcl.com/blog/wi-fi-marketing-a-stepping-stone-to-boost-your-business/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Wi-Fi Marketing: A Stepping Stone to Boost Your Business" />
							<meta property="og:description" content="Discover the Power of Wi-Fi Marketing for Your Business Growth. Unlock New Opportunities and Connect with Customers. Explore Wi-Fi Marketing Solutions Today!"/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/06/blogpage-10.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Wi-Fi Marketing: A Stepping Stone to Boost Your Business" />
							<meta property="twitter:description" content="Discover the Power of Wi-Fi Marketing for Your Business Growth. Unlock New Opportunities and Connect with Customers. Explore Wi-Fi Marketing Solutions Today!"/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/06/blogpage-10.jpg"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/eliminate-network-latency-with-wifi-6-routers/') 
			{
		   echo '<title>Supercharge Your Wi-Fi: Ways to Eliminate Network Latency with Intelligent Routers</title>
							<meta name="title" content="Supercharge Your Wi-Fi: Ways to Eliminate Network Latency with Intelligent Routers" />
							<meta name="description" content="Discover how you can eliminate network latency with home mesh routers to optimize your network performance, reduce latency, and enhance online experience."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/eliminate-network-latency-with-wifi-6-routers/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Supercharge Your Wi-Fi: Ways to Eliminate Network Latency with Intelligent Routers" />
							<meta property="og:description" content="Discover how you can eliminate network latency with home mesh routers to optimize your network performance, reduce latency, and enhance the online experience."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/1-01-2048x1152.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Supercharge Your Wi-Fi: Ways to Eliminate Network Latency with Intelligent Routers" />
							<meta property="twitter:description" content="Discover how you can eliminate network latency with home mesh routers to optimize your network performance, reduce latency, and enhance online experience."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/1-01-2048x1152.jpg"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/wi-fi-6-mapping-new-routes-for-the-automotive-industry/') 
			{
		   echo '<title>Wi-Fi 6 Mapping New Routes for the Automotive Industry</title>
							<meta name="title" content="Wi-Fi 6 Mapping New Routes for the Automotive Industry" />
							<meta name="description" content="Discover how Wi-Fi 6 is revolutionizing the automotive industry, paving the way for innovation and connectivity. Explore the latest advancements in automotive technology."/>
							<link rel="canonical" https://io.hfcl.com/blog/eliminate-network-latency-with-wifi-6-routers/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Wi-Fi 6 Mapping New Routes for the Automotive Industry" />
							<meta property="og:description" content="Discover how Wi-Fi 6 is revolutionizing the automotive industry, paving the way for innovation and connectivity. Explore the latest advancements in automotive technology."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/10/shutterstock_1096130420-2048x1219.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Wi-Fi 6 Mapping New Routes for the Automotive Industry" />
							<meta property="twitter:description" content="Discover how Wi-Fi 6 is revolutionizing the automotive industry, paving the way for innovation and connectivity. Explore the latest advancements in automotive technology."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2022/10/shutterstock_1096130420-2048x1219.jpg"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/what-is-access-point/') 
			{
		   echo '<title>Access Points: The Backbone of Wireless Connectivity</title>
							<meta name="title" content="Access Points: The Backbone of Wireless Connectivity" />
							<meta name="description" content="In this blog get insights of the unparalleled benefits Access Points bring to creating robust, high-speed wireless networks."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/what-is-access-point/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Access Points: The Backbone of Wireless Connectivity" />
							<meta property="og:description" content="In this blog get insights of the unparalleled benefits Access Points bring to creating robust, high-speed wireless networks."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/backbone.png" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Access Points: The Backbone of Wireless Connectivity" />
							<meta property="twitter:description" content="In this blog get insights of the unparalleled benefits Access Points bring to creating robust, high-speed wireless networks."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/backbone.png"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/resolve-mdu-wifi-issues-with-access-points/') 
			{
		   echo '<title>How to Troubleshoot MDU Wi-Fi Network Issues with Access Points?</title>
							<meta name="title" content="How to Troubleshoot MDU Wi-Fi Network Issues with Access Points?" />
							<meta name="description" content="This blog offers insights into resolving common MDU Wi-Fi network challenges with Access Points."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/resolve-mdu-wifi-issues-with-access-points/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="How to Troubleshoot MDU Wi-Fi Network Issues with Access Points?" />
							<meta property="og:description" content="This blog offers insights into resolving common MDU Wi-Fi network challenges with Access Points."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/1.png" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="How to Troubleshoot MDU Wi-Fi Network Issues with Access Points?" />
							<meta property="twitter:description" content="This blog offers insights into resolving common MDU Wi-Fi network challenges with Access Points."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/07/1.png"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/fueling-progress-in-the-oil-and-gas-industry-with-wireless-network-solutions/') 
			{
		   echo '<title>Fueling Progress in the Oil and Gas Industry with Advanced Wireless Solutions</title>
						<meta name="title" content="Fueling Progress in the Oil and Gas Industry with Advanced Wireless Solutions" />
						<meta name="description" content="Discover how the oil and gas industry is leveraging wireless network solutions to enhance efficiency, improve safety, and revolutionize operations."/>
						<link rel="canonical" href="https://io.hfcl.com/blog/fueling-progress-in-the-oil-and-gas-industry-with-wireless-network-solutions/" />

						 <!-- Facebook Meta Tags -->
						<meta property="og:type" content="website" />
						<meta property="og:url" content="https://io.hfcl.com/" />
						<meta property="og:title" content="Fueling Progress in the Oil and Gas Industry with Advanced Wireless Solutions" />
						<meta property="og:description" content="Discover how the oil and gas industry is leveraging wireless network solutions to enhance efficiency, improve safety, and revolutionize operations."/>
						<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/MicrosoftTeams-image-7.png" />

						 <!-- Twitter Meta Tags -->
						<meta property="twitter:card" content="summary_large_image" />
						<meta property="twitter:domain" content="io.hfcl.com/" />
						<meta property="twitter:url" content="https://io.hfcl.com/" />
						<meta property="twitter:title" content="Fueling Progress in the Oil and Gas Industry with Advanced Wireless Solutions" />
						<meta property="twitter:description" content="Discover how the oil and gas industry is leveraging wireless network solutions to enhance efficiency, improve safety, and revolutionize operations."/>
						<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/MicrosoftTeams-image-7.png"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/best-place-to-put-wi-fi-router/') 
			{
		   echo '<title>How To Position Your Wi-Fi Router For Optimal Performance?</title>
							<meta name="title" content="How To Position Your Wi-Fi Router For Optimal Performance?" />
							<meta name="description" content="Optimize your connection with our guide on positioning your Wi-Fi router. Ensure your wireless router delivers maximum speed and coverage."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/best-place-to-put-wi-fi-router/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="How To Position Your Wi-Fi Router For Optimal Performance?" />
							<meta property="og:description" content="Optimize your connection with our guide on positioning your Wi-Fi router. Ensure your wireless router delivers maximum speed and coverage."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/Artboard-1-copy-2.png" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="How To Position Your Wi-Fi Router For Optimal Performance?" />
							<meta property="twitter:description" content="Optimize your connection with our guide on positioning your Wi-Fi router. Ensure your wireless router delivers maximum speed and coverage."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/Artboard-1-copy-2.png"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/what-is-ont/') 
			{
		   echo '<title>Exploring ONT: The Cornerstone of Modern Optical Networking</title>
							<meta name="title" content="Exploring ONT: The Cornerstone of Modern Optical Networking" />
							<meta name="description" content="Dive into our comprehensive ONT guide and discover how it blends with optical fiber to revolutionize modern networking, providing faster and more reliable connections."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/what-is-ont/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Exploring ONT: The Cornerstone of Modern Optical Networking" />
							<meta property="og:description" content="Dive into our comprehensive ONT guide and discover how it blends with optical fiber to revolutionize modern networking, providing faster and more reliable connections."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/ONT-Banner-Image.png" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Exploring ONT: The Cornerstone of Modern Optical Networking" />
							<meta property="twitter:description" content="Dive into our comprehensive ONT guide and discover how it blends with optical fiber to revolutionize modern networking, providing faster and more reliable connections."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/08/ONT-Banner-Image.png"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/ont-devices-bridging-the-gap-to-ultra-fast-internet/') 
			{
		   echo '<title>ONT Devices: Bridging the Gap to Ultra-Fast Internet</title>
							<meta name="title" content="ONT Devices: Bridging the Gap to Ultra-Fast Internet" />
							<meta name="description" content="Discover the pivotal role of ONT devices in bridging fiber-optic networks and user devices, delivering high-speed, ultra-reliable connectivity for a seamless digital experience."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/ont-devices-bridging-the-gap-to-ultra-fast-internet/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="ONT Devices: Bridging the Gap to Ultra-Fast Internet" />
							<meta property="og:description" content="Discover the pivotal role of ONT devices in bridging fiber-optic networks and user devices, delivering high-speed, ultra-reliable connectivity for a seamless digital experience."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-ONT-Device-Blog.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="ONT Devices: Bridging the Gap to Ultra-Fast Internet" />
							<meta property="twitter:description" content="Discover the pivotal role of ONT devices in bridging fiber-optic networks and user devices, delivering high-speed, ultra-reliable connectivity for a seamless digital experience."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-ONT-Device-Blog.jpg"/>';
			}
			elseif ($url == 'https://io.hfcl.com/blog/wired-to-win-an-ultimate-guide-to-poe-switches/') 
			{
		   echo '<title>Wired to Win: An Ultimate Guide to PoE Switches</title>
							<meta name="title" content="Wired to Win: An Ultimate Guide to PoE Switches" />
							<meta name="description" content="Get familiar with PoE switches, their benefits, PoE devices, the need for PoE switches and more in our ultimate guide on PoE switches."/>
							<link rel="canonical" href="https://io.hfcl.com/blog/wired-to-win-an-ultimate-guide-to-poe-switches/" />

							 <!-- Facebook Meta Tags -->
							<meta property="og:type" content="website" />
							<meta property="og:url" content="https://io.hfcl.com/" />
							<meta property="og:title" content="Wired to Win: An Ultimate Guide to PoE Switches" />
							<meta property="og:description" content="Get familiar with PoE switches, their benefits, PoE devices, the need for PoE switches and more in our ultimate guide on PoE switches."/>
							<meta property="og:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-for-Blog-PoE-Switches.jpg" />

							 <!-- Twitter Meta Tags -->
							<meta property="twitter:card" content="summary_large_image" />
							<meta property="twitter:domain" content="io.hfcl.com/" />
							<meta property="twitter:url" content="https://io.hfcl.com/" />
							<meta property="twitter:title" content="Wired to Win: An Ultimate Guide to PoE Switches" />
							<meta property="twitter:description" content="Get familiar with PoE switches, their benefits, PoE devices, the need for PoE switches and more in our ultimate guide on PoE switches."/>
							<meta property="twitter:image" content="https://io.hfcl.com/blog/wp-content/uploads/2023/09/Banner-Image-for-Blog-PoE-Switches.jpg"/>';
			}
			else
			{
			   echo '<title>Blog Details | IO by HFCL</title>';
			   echo '<meta name="description" content="Blog">';
			}
		?>
    <meta charset="
		<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="
		<?php echo get_template_directory_uri(); ?>/css/slick.css">
    <link rel="stylesheet" href="
		<?php echo get_template_directory_uri(); ?>/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/style.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/default-edit.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/responsive2.css">
    <link rel="stylesheet" type="text/css" href="https://io.hfcl.com/css/owl.carousel.css">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="114x114" href="https://io.hfcl.com/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://io.hfcl.com/images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://io.hfcl.com/images/favicon.png">
    <link rel="mask-icon" href="https://io.hfcl.com/images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicon --> <?php wp_head(); ?> <style type="text/css">
      .timeshownw span.rt-reading-time {
        display: inline-block !important;
      }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-0MV8RQ611Y"></script>

		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-0MV8RQ611Y');
		</script>


		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

		<script type="application/ld+json">
		{
		"@context": "http://schema.org", 
		"@type": "Corporation", 
		"name": "IO by HFCL", 
		"description": "IO by HFCL is a leading technology company specializing in telecom infrastructure, FTTH services, smart city solutions, IoT, data centers, and cloud services. Committed to innovation and sustainability, IO serves customers globally with a customer-centric approach.", 
		"logo": "https://io.hfcl.com/images/IO-logo-stockholm.png", 
		"address": 
		{
		"@type": "PostalAddress", 
		"addressCountry": "India", 
		"addressLocality": "Haryana", 
		"addressRegion": "Gurugram", 
		"postalCode": "122001", 
		"streetAddress": "Plot No 38, Institutional Area, Sector 32"}, 
		"email": "mailto:iosupport@hfcl.com", 
		"telephone": "8792701100", 
		"url": "https://io.hfcl.com/", 
		"sameAs": ["https://twitter.com/iobyhfcl", "https://www.linkedin.com/company/iobyhfcl", "https://www.instagram.com/iobyhfcl", "https://www.youtube.com/@iobyhfcl"]
		}
		</script>

  </head>
  <body <?php body_class('innerpage'); ?>> <?php do_action( 'wp_body_open' ); ?> <div id="page" class="site">
      <a class="skip-link screen-reader-text" href="#content"> <?php esc_html_e( 'Skip to content', 'online-photography' ); ?> </a> <?php if( is_front_page() || !is_paged() ) {
		get_template_part( 'inc/header', 'image' );
	} ?> <div class="wrapper">
        <!-- offcanvas-start -->
        <div class="offcanvas-menu">
          <div class="offmenu" id="menuParent">
            <a href="javascript:void(0)" class="offcanvas-close">
              <i class="far fa-times"></i>
            </a>
            <img src="https://io.hfcl.com/images/logo.svg" class="logo-mobile-menu">
            <ul class="mobile-menu">
              <li class="dropdown">
                <a href="https://io.hfcl.com/products" data-bs-toggle="collapse" data-bs-target="#drop-menu1" class="collapsed">Products</a>
                <div class="dropdown-menu-custom collapse" id="drop-menu1" data-bs-parent="#menuParent">
                  <ul class="mg-ul">
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub1">Wi-Fi</p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub1">
                        <li class="Access Points">
                          <a href="https://io.hfcl.com/products/access-points">Access Points</a>
                        </li>
                        <li>
                          <a href="https://io.hfcl.com/home-mesh-router">HMR</a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub2">Managed Switches</p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub2">
                        <li class="Commercial Access Switch">
                          <a href="https://io.hfcl.com/products/commercial-access-switch">Commercial Access Switch</a>
                        </li>
                        <li class="Industrial Access Switch">
                          <a href="https://io.hfcl.com/products/industrial-access-switch">Industrial Access Switch</a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub3">UBR</p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub3">
                        <li class="P2P">
                          <a href="https://io.hfcl.com/products/p2p">P2P</a>
                        </li>
                        <li class="P2MP">
                          <a href="https://io.hfcl.com/products/p2mp">P2MP</a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub4">Cloud Networking Platforms </p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub4">
                        <li>
                          <a href="https://io.hfcl.com/products/cnms">cNMS</a>
                        </li>
                        <li>
                          <a href="https://io.hfcl.com/products/ems">EMS</a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub5">Accessories</p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub5">
                        <li class="Power Solutions AC /DC PoE Injectors">
                          <a href="https://io.hfcl.com/products/power-solutions-ac-dc-poe-injectors">Power Solutions AC /DC PoE Injectors</a>
                        </li>
                        <li class="Antennas">
                          <a href="https://io.hfcl.com/products/antennas">Antennas</a>
                        </li>
                      </ul>
                    </div>
                    <div class="dropsub">
                      <div class="drophead">
                        <p data-bs-toggle="collapse" data-bs-target="#drop-menu-sub6">Passive Optical Network</p>
                      </div>
                      <ul class="collapse" id="drop-menu-sub6">
                        <li class="xPON">
                          <a href="https://io.hfcl.com/products/xpon">xPON</a>
                        </li>
                      </ul>
                    </div>
                  </ul>
                </div>
              </li>
              <li class="dropdown">
                <a href="https://io.hfcl.com/industries" data-bs-toggle="collapse" data-bs-target="#drop-menu2" class="collapsed">Industries</a>
                <div class="dropdown-menu-custom collapse" id="drop-menu2" data-bs-parent="#menuParent">
                  <ul class="mg-ul medium-menu-mobile">
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/tsp-isp">
                        <img src="https://io.hfcl.com/images/industry/t1-1632721933-1_crop.png" alt="TSP/ISP" loading="lazy">
                        <span>TSP/ISP</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/hospitality">
                        <img src="https://io.hfcl.com/images/industry/hospitality-1630576105-1_crop.png" alt="Hospitality" loading="lazy">
                        <span>Hospitality</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/education">
                        <img src="https://io.hfcl.com/images/industry/education-1630577381-1_crop.png" alt="Education" loading="lazy">
                        <span>Education</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/healthcare">
                        <img src="https://io.hfcl.com/images/industry/healthcare-1632725466-1_crop.png" alt="Healthcare" loading="lazy">
                        <span>Healthcare</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/public-wi-fi">
                        <img src="https://io.hfcl.com/images/industry/public_hotspt-1632727904-1_crop.png" alt="Public Wi-Fi" loading="lazy">
                        <span>Public Wi-Fi</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/public-hotspots">
                        <img src="https://io.hfcl.com/images/industry/small_medium-1633021242-1_crop.png" alt="Public Hotspots" loading="lazy">
                        <span>Public Hotspots</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/mining">
                        <img src="https://io.hfcl.com/images/industry/minin-1632728743-1_crop.png" alt="Mining" loading="lazy">
                        <span>Mining</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/defence">
                        <img src="https://io.hfcl.com/images/industry/defence-1632729795-1_crop.png" alt="Defence" loading="lazy">
                        <span>Defence</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/smes">
                        <img src="https://io.hfcl.com/images/industry/small_medium-1632731477-1_crop.png" alt="SMEs" loading="lazy">
                        <span>SMEs</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/enterprise">
                        <img src="https://io.hfcl.com/images/industry/enterprise-1630577234-1_crop.png" alt="Enterprise" loading="lazy">
                        <span>Enterprise</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/retail">
                        <img src="https://io.hfcl.com/images/industry/retail-1630576666-1_crop.png" alt="Retail" loading="lazy">
                        <span>Retail</span>
                      </a>
                    </li>
                    <li class="match">
                      <a href="https://io.hfcl.com/industries/cctv">
                        <img src="https://io.hfcl.com/images/industry/cctv-1633021197-1_crop.png" alt="CCTV" loading="lazy">
                        <span>CCTV</span>
                      </a>
                    </li>
                    <li class="match" style="">
                      <a href="https://io.hfcl.com/industries/iiot">
                        <img src="https://io.hfcl.com/images/industry/retail-1630576981-1_crop.png" alt="IIoT" loading="lazy">
                        <span>IIoT</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="dropdown">
                <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#drop-menu3" class="collapsed">Resources</a>
                <div class="dropdown-menu-custom collapse" id="drop-menu3" data-bs-parent="#menuParent">
                  <ul class="mg-ul flex-column medium-menu-mobile">
                    <li>
                      <a href="https://io.hfcl.com/blogs">
                        <img src="https://io.hfcl.com/images/megamenu/blogs.svg"> Blogs </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/whitepapers">
                        <img src="https://io.hfcl.com/images/megamenu/file-type.svg"> Whitepapers </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/casestudies">
                        <img src="https://io.hfcl.com/images/megamenu/file-type.svg"> Case Studies </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/documentation">
                        <img src="https://io.hfcl.com/images/megamenu/documentation.svg"> Documentation </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/videos">
                        <img src="https://io.hfcl.com/images/megamenu/videos.svg"> Videos </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/infographic">
                        <img src="https://io.hfcl.com/images/megamenu/infographic.svg"> Infographic </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/pressrelease">
                        <img src="https://io.hfcl.com/images/megamenu/press.svg"> Press Releases </a>
                    </li>
                    <li>
                      <a href="https://io.hfcl.com/events">
                        <img src="https://io.hfcl.com/images/megamenu/events.svg"> Events </a>
                    </li>
                    
                  </ul>
                </div>
              </li>
              <li class="linkpannr">
                <a href="https://io.hfcl.com/linkxpert">LinkXpert</a>
              </li>
              <li>
                <a href="https://io.hfcl.com/contact-us">Book a Demo</a>
              </li>
            </ul>
            <div class="d-flex mt-3">
              <a href="https://iopartner.hfcl.com/login" class="s-button">
                <img src="https://io.hfcl.com/images/user-icon.svg" alt="" />
                <span class="txt">Partner Portal</span>
              </a>
            </div>
          </div>
        </div>
        <div class="offcanvas-overlay"></div>
        <!-- offcanvas-start-end -->
        <!-- header-section -->
        <header class="header-section">
          <div class="container">
            <div class="header-section__inner">
              <a href="https://io.hfcl.com" class="header_logo">
                <img src="https://io.hfcl.com/images/logo.svg" alt="logo" />
              </a>
              <div class="main-menu d-lg-block d-none">
                <ul>
                  <li>
                    <a href="https://io.hfcl.com/products">Products</a>
                    <div class="mega-menu">
                      <ul class="mg-ul">
                        <div class="dropsub">
                          <div class="drophead">
                            <p>Wi-Fi</p>
                          </div>
                          <ul>
                            <li class="Access Points">
                              <a href="https://io.hfcl.com/products/access-points">Access Points</a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/home-mesh-router">HMR</a>
                            </li>
                          </ul>
                        </div>
                        <div class="dropsub">
                          <div class="drophead">
                            <p>Managed Switches</p>
                          </div>
                          <ul>
                            <li class="Commercial Access Switch">
                              <a href="https://io.hfcl.com/products/commercial-access-switch">Commercial Access Switch</a>
                            </li>
                            <li class="Industrial Access Switch">
                              <a href="https://io.hfcl.com/products/industrial-access-switch">Industrial Access Switch</a>
                            </li>
                          </ul>
                        </div>
                        <div class="dropsub">
                          <div class="drophead">
                            <p>UBR</p>
                          </div>
                          <ul>
                            <li class="P2P">
                              <a href="https://io.hfcl.com/products/p2p">P2P</a>
                            </li>
                            <li class="P2MP">
                              <a href="https://io.hfcl.com/products/p2mp">P2MP</a>
                            </li>
                          </ul>
                        </div>
                        <div class="dropsub">
                          <div class="drophead">
                            <p>Cloud Networking Platforms </p>
                          </div>
                          <ul>
                            <li>
                              <a href="https://io.hfcl.com/products/cnms">cNMS</a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/products/ems">EMS</a>
                            </li>
                          </ul>
                        </div>
                        <div class="dropsub">
                          <div class="drophead">
                            <p>Accessories</p>
                          </div>
                          <ul>
                            <li class="Power Solutions AC /DC PoE Injectors">
                              <a href="https://io.hfcl.com/products/power-solutions-ac-dc-poe-injectors">Power Solutions AC /DC PoE Injectors</a>
                            </li>
                            <li class="Antennas">
                              <a href="https://io.hfcl.com/products/antennas">Antennas</a>
                            </li>
                          </ul>
                        </div>
                        <div class="dropsub">
                          <div class="drophead">
                            <p>Passive Optical Network</p>
                          </div>
                          <ul>
                            <li class="xPON">
                              <a href="https://io.hfcl.com/products/xpon">xPON</a>
                            </li>
                          </ul>
                        </div>
                      </ul>
                    </div>
                  </li>
                  <li class="<?php if($currentPage=='industry' || $currentPage=='industry-details') { echo 'active'; }?>">
                    <a href="https://io.hfcl.com/industries">Industries</a>
                    <div class="mega-menu medium-menu">
                      <ul class="mg-ul medium-menu-mobile">
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/tsp-isp">
                            <img src="https://io.hfcl.com/images/industry/t1-1632721933-1_crop.png" alt="TSP/ISP" loading="lazy">
                            <span>TSP/ISP</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/hospitality">
                            <img src="https://io.hfcl.com/images/industry/hospitality-1630576105-1_crop.png" alt="Hospitality" loading="lazy">
                            <span>Hospitality</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/education">
                            <img src="https://io.hfcl.com/images/industry/education-1630577381-1_crop.png" alt="Education" loading="lazy">
                            <span>Education</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/healthcare">
                            <img src="https://io.hfcl.com/images/industry/healthcare-1632725466-1_crop.png" alt="Healthcare" loading="lazy">
                            <span>Healthcare</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/public-wi-fi">
                            <img src="https://io.hfcl.com/images/industry/public_hotspt-1632727904-1_crop.png" alt="Public Wi-Fi" loading="lazy">
                            <span>Public Wi-Fi</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/public-hotspots">
                            <img src="https://io.hfcl.com/images/industry/small_medium-1633021242-1_crop.png" alt="Public Hotspots" loading="lazy">
                            <span>Public Hotspots</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/mining">
                            <img src="https://io.hfcl.com/images/industry/minin-1632728743-1_crop.png" alt="Mining" loading="lazy">
                            <span>Mining</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/defence">
                            <img src="https://io.hfcl.com/images/industry/defence-1632729795-1_crop.png" alt="Defence" loading="lazy">
                            <span>Defence</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/smes">
                            <img src="https://io.hfcl.com/images/industry/small_medium-1632731477-1_crop.png" alt="SMEs" loading="lazy">
                            <span>SMEs</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/enterprise">
                            <img src="https://io.hfcl.com/images/industry/enterprise-1630577234-1_crop.png" alt="Enterprise" loading="lazy">
                            <span>Enterprise</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/retail">
                            <img src="https://io.hfcl.com/images/industry/retail-1630576666-1_crop.png" alt="Retail" loading="lazy">
                            <span>Retail</span>
                          </a>
                        </li>
                        <li class="match">
                          <a href="https://io.hfcl.com/industries/cctv">
                            <img src="https://io.hfcl.com/images/industry/cctv-1633021197-1_crop.png" alt="CCTV" loading="lazy">
                            <span>CCTV</span>
                          </a>
                        </li>
                        <li class="match" style="">
                          <a href="https://io.hfcl.com/industries/iiot">
                            <img src="https://io.hfcl.com/images/industry/retail-1630576981-1_crop.png" alt="IIoT" loading="lazy">
                            <span>IIoT</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li>
                    <a href="javascript:void(0)">Resources</a>
                    <div class="mega-menu medium-menu widthfix">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="drophead">
                            <p>LEARN</p>
                          </div>
                          <ul class="mg-ul">
                            <li>
                              <a href="https://io.hfcl.com/blogs">
                                <img src="https://io.hfcl.com/images/megamenu/blogs.svg"> Blogs </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/casestudies">
                                <img src="https://io.hfcl.com/images/megamenu/file-type.svg"> Case Studies </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/whitepapers">
                                <img src="https://io.hfcl.com/images/megamenu/file-type.svg"> Whitepapers </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/videos">
                                <img src="https://io.hfcl.com/images/megamenu/videos.svg"> Videos </a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-md-6">
                          <div class="drophead">
                            <p>EXPLORE</p>
                          </div>
                          <ul class="mg-ul">
                            <li>
                              <a href="https://io.hfcl.com/pressrelease">
                                <img src="https://io.hfcl.com/images/megamenu/press.svg"> Press Releases </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/events">
                                <img src="https://io.hfcl.com/images/megamenu/events.svg"> Events </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/infographic">
                                <img src="https://io.hfcl.com/images/megamenu/infographic.svg"> Infographic </a>
                            </li>
                            <li>
                              <a href="https://io.hfcl.com/documentation">
                                <img src="https://io.hfcl.com/images/megamenu/documentation.svg"> Documentation </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a href="https://io.hfcl.com/linkxpert">LinkXpert</a>
                  </li>
                </ul>
              </div>
              <div class="searchnbtn">
									<a href="https://io.hfcl.com/contact-us" class="s-button d-lg-flex d-none">
			              <span class="txt">Book a Demo</span>
			            </a>
		            	<a href="https://iopartner.hfcl.com/login" class="s-button d-lg-flex d-none partner-btn">
			              <span class="txt">Partner Portal</span>
			            </a>
		            	<a href="javascript:void(0)" class="searchclick"><i class="fa fa-search" aria-hidden="true"></i></a>
		            </div>
              <!-- menu-open -->
              <a href="javascript:void(0)" class="offcanvas-open d-lg-none ms-auto">
                <i class="far fa-bars"></i>
              </a>
            </div>
          </div>
          <div class="searchbar">
            <form class="search" method="GET" action="https://io.hfcl.com/search">
              <div class="form-group">
                <input type="text" required="required" name="search" class="form-control" placeholder="Search..">
                <p>Enter your query and find the solution</p>
              </div>
              <div class="closesearch">
                <i class="fa fa-times" aria-hidden="true"></i>
              </div>
            </form>
          </div>
        </header>
        <!--End header-section -->