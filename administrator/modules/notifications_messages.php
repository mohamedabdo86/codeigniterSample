<?php

class Messages
{
	public static function add_item($message = "Item is added successfully.")
	{
		echo '<h4 class="alert_success">'.$message.'</h4>';
		
	}
	public static function edit_item($message = "Item is updated successfully.")
	{
		$message_display =  "
		$.gritter.add({
						class_name: 'notification_green_color',
						title: '{$title}',
						text: '{$message}',
						sticky: false,
						time: '2500',
						fade_out_speed : 1500,
						 
					});
		";
		
	}
	public static function green_ballon($title = "Deleted!" ,$message = "Selected row deleted.")
	{
		$message_display =  "
		$.gritter.add({
						class_name: 'notification_green_color',
						title: '{$title}',
						text: '{$message}',
						sticky: false,
						time: '2500',
						fade_out_speed : 1500,
						 
					});
		";
		
		return $message_display ;
		
	}
	public static function red_ballon($title = "Deleted!" ,$message = "Selected row deleted.")
	{
		$message_display =  "
		$.gritter.add({
						class_name: 'notification_red_color',
						title: '{$title}',
						text: '{$message}',
						sticky: false,
						time: '2500',
						fade_out_speed : 1500,
						 
					});
		";
		
		return $message_display ;
		
	}
	public static function error_on_action($message = "An Errored Occuried")
	{
		echo '<h4 class="alert_warning">'.$message.'</h4>';
		
	}
	
	public static function get_error_message($message)
	{
		switch($message)
		{
			case "width_restriction":
			$display_error_message  = "The Uploaded Image doesn't meet the width restriction";
			break;
			case "height_restriction":
			$display_error_message  = "The Uploaded Image doesn't meet the height restriction";
			break;
			case "notvalid":
			$display_error_message  = "The extension of the file is not valid.";
			break;
			case "maxsize":
			$display_error_message  = "File exceeded the maximum size(200 kb)";
			break;
			case "cantupload":
			$display_error_message  = "File Can't be uploaded";
			break;
			case "notwritable":
			$display_error_message  = "Folder not writable";
			break;
			case "emptyfile":
			$display_error_message  = "Empty File found";
			break;
			default:
			$display_error_message  = "File Can't be uploaded";
			
		}
		
		return $display_error_message;
	}
	
	public static function get_notifications_message($message)
	{
		$notifications_message = array();
		switch($message)
		{
			case "item_deleted":
			$notifications_message['title']  = "Deleted!";
			$notifications_message['msg']  = "Selected row deleted";
			break;
			case "item_updated":
			$notifications_message['title']  = "Updated!";
			$notifications_message['msg']  = "Data are Updated.";
			break;
			default:
			$notifications_message['title']  = "Error!";
			$notifications_message['msg']  = "An error Occured";
			
		}
		
		return $notifications_message;
	}
	
	public static function generate_notification_ballon($state)
	{
		$error_code = $_GET['error_code'];
		$display_result = "";
		
		if($state != "")
		{
			if($state == "added" || $state == "updated" )
			{
				$display_result.= '
				<script type="text/javascript">
				$(document).ready(
				function()
				{
				';
					$message_array = self::get_notifications_message("item_updated");
						
					$display_result.= self::green_ballon($message_array['title'],$message_array['msg']);
				$display_result.= '
				}
				);
				</script>
				';
			}
			if($state == "error")
			{
				$display_result.= '
				<script type="text/javascript">
				$(document).ready(
				function()
				{
				';
				$message_array = self::get_notifications_message();	
				
				if($error_code != "")
				$message_array['msg'].= ", ".self::get_error_message($error_code);
					
				$display_result.= self::red_ballon($message_array['title'],$message_array['msg']);
				$display_result.= '
				}
				);
				</script>
				';
			}
			
		}
		
		
		return $display_result;
		
	}
}
?>