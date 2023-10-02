<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncController extends Controller
{
    public static  function emailfilter($str)
    {
      $re = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
  
  
      if (preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0) == true) {
        return "good";
      } else {
        return "fail";
      }
    }
    public static  function phonenummber($str)
    {

  
  
      if (is_numeric($str)) {
        return "good";
      } else {
        return "fail";
      }
    }
    public static  function message($str)
    {
      $re = '/[^0-9A-Za-z]/';
  
  
      if (preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0) == true) {
        return "good";
      } else {
        return "fail";
      }
    }
    public static  function passwordfilter($str)
    {
      $re = '/^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8,30}$/';
  
      if (preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0) == true) {
        return "good";
      } else {
        return "fail";
      }
      
    }
    public static  function xssfilter($str)
    {
      $danger = array("<", ">", "/", "src", "select", "*", "<script>", "%", "&","?","=","(", ")");
      $xss_filter = str_replace($danger, "", $str);
      return  $xss_filter;
    }
  
    public static  function linkfilter($str)
    {
      $danger = array("<", ">","(", ")", "/","!","?","=","*", "<script>", "%", "&");
      $xss_filter = str_replace($danger, "", $str);
      return  $xss_filter;
    }
}
