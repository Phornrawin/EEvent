@extends('layouts.app')
 
 @section('content')
 <style type="text/css">
      .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
+            font-size: 17px;
+            width: 50%;
+        }
+
+        .tablink:hover {
+            background-color: #777;
+        }
+    </style>
+    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
+    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>