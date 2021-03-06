<?php

if ( ! function_exists( 'alpha_svg' ) ) {

	function alpha_svg( $type ) {

		switch ( $type ) {

			case 'hamburger':
				return '<svg class="krown-svg hamburger" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="20" width="25" height="4"/><rect x="18" y="28" width="25" height="4"/><rect x="18" y="36" width="25" height="4"/></g></svg>';
				break;

			case 'close':	
				return '<svg class="krown-svg close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="28" transform="matrix(0.7071 0.7071 -0.7071 0.7071 30.1464 -12.78)" width="25" height="4"/><rect x="18" y="28" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -12.28 30.3536)" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_right':
				return '<svg class="krown-svg arrow_right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="45.328,29 42.5,26.172 35.075,18.747 32.247,21.575 39.672,29 32.247,36.425 35.075,39.253 42.5,31.828 "/><g><rect x="16" y="27" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_left':
				return '<svg class="krown-svg arrow_left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="16,29 18.828,31.828 26.253,39.253 29.081,36.425 21.656,29 29.081,21.575 26.253,18.747 18.828,26.172 "/><g><rect x="20.328" y="27" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_down':
				return '<svg class="krown-svg arrow_down" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="26.414,28.008 30.414,32.008 34.414,28.008 "/></svg>';
				break;

			case 'arrow_up':
				return '<svg class="krown-svg arrow_up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polygon fill="#FFFFFF" points="29.791,22.459 26.962,25.288 19.538,32.713 22.366,35.541 29.791,28.116 37.215,35.541 40.043,32.713 32.619,25.288 "/></svg>';
				break;

			case 'filter':
				return '<svg class="krown-svg filter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="20" width="4" height="4"/><rect x="18" y="28" width="4" height="4"/><rect x="18" y="36" width="4" height="4"/><polyline points="26,20 30,20 30,24 26,24"/><polyline points="26,28 30,28 30,32 26,32"/><polyline points="26,36 30,36 30,40 26,40"/><polyline points="34,20 38,20 38,24 34,24"/><polyline points="34,28 38,28 38,32 34,32"/></g></svg>';
				break;

			case 'cart':
				return '<svg version="1.1" class="krown-svg cart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><g><path d="M72.715,29.241H16.074c-4.416,0-2.961,3.613-2.961,8.03l3.802,38.897c0,4.416,3.614,4.229,8.031,4.229h38.896c4.416,0,8.664,0.188,8.664-4.229l3.167-38.897C75.674,32.854,77.131,29.241,72.715,29.241z"/><path d="M44.394,10.491c7.146,0,12.961,5.814,12.961,12.961h3.543c0-9.101-7.403-16.505-16.504-16.505c-9.1,0-16.503,7.404-16.503,16.505h3.543C31.434,16.306,37.249,10.491,44.394,10.491z"/></g></svg>';
				break;

			case 'swipe-left':
				return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><line fill="#000000" x1="48.1" y1="34.61" x2="61.5" y2="34.61"/><path fill="#000000" d="M61.5 35.5H48.1c-0.49 0-0.89-0.4-0.89-0.89s0.4-0.89 0.89-0.89h13.41c0.49 0 0.89 0.4 0.89 0.89S62 35.5 61.5 35.5z"/><path fill="#000000" d="M50.78 38.19c-0.23 0-0.46-0.09-0.63-0.26l-2.68-2.68c-0.17-0.17-0.26-0.39-0.26-0.63 0-0.24 0.1-0.46 0.26-0.63l2.68-2.68c0.35-0.35 0.92-0.35 1.26 0 0.35 0.35 0.35 0.92 0 1.26l-2.05 2.05 2.05 2.05c0.35 0.35 0.35 0.91 0 1.26C51.24 38.1 51.01 38.19 50.78 38.19z"/><path fill="#000000" d="M65 41.95c0-0.74 0-1.44 0-2.1 -2-1.18-2.64-3.08-2.64-5.24 0-3.57 2.93-6.48 6.5-6.48s6.65 2.91 6.65 6.48c0 2.15-1.51 4.06-2.51 5.24v2.1c2-1.38 4.31-4.15 4.31-7.34 0-4.56-3.79-8.27-8.35-8.27s-8.35 3.71-8.35 8.27C60.61 37.8 62 40.57 65 41.95z"/><path fill="#000000" d="M92.79 51.47h-2.23c-0.63 0-1.27 0.15-1.84 0.43 -0.29-1.68-1.76-2.96-3.52-2.96h-2.23c-0.74 0-1.42 0.22-1.99 0.61 -0.49-1.39-1.82-2.38-3.37-2.38h-2.23c-0.65 0-1.26 0.18-1.79 0.48V34.61c0-2.59-2.1-4.69-4.69-4.69 -2.59 0-4.69 2.11-4.69 4.69v24.75c-1 0.48-1.93 1.12-2.74 1.92l-1.83 1.83c-3.83 3.83-3.83 10.07 0 13.9l5.11 5.11c0.25 0.25 0.51 0.48 0.78 0.7 1.7 2.93 4.88 4.91 8.52 4.91H86.53c5.42 0 9.83-4.39 9.83-9.79V55.05C96.36 53.07 94.76 51.47 92.79 51.47zM94.58 77.94c0 4.41-3.61 8-8.04 8H74.02c-1.47 0-2.85-0.4-4.04-1.09 -0.99-0.59-2.09-1.45-3.09-3.22 -0.58-1.1-0.91-2.36-0.91-3.69 0-0.49-0.4-0.89-0.89-0.89 -0.49 0-0.89 0.4-0.89 0.9 0 0.41 0.03 0.81 0.08 1.2l-3.39-3.39c-3.14-3.14-3.14-8.24 0-11.38l1.83-1.83c0.45-0.45 0.95-0.83 1.48-1.16v6.12c0 0.49 0.4 0.89 0.89 0.89 0.49 0 0.9-0.4 0.9-0.89V34.61c0-1.6 1.3-2.9 2.9-2.9s2.91 1.3 2.91 2.9V57.57c0 0.49 0.4 0.89 0.89 0.89 0.49 0 0.89-0.4 0.89-0.89v-6.83c0-0.99 0.8-1.79 1.79-1.79h2.23c0.99 0 1.79 0.8 1.79 1.79v6.84c0 0.49 0.4 0.89 0.9 0.89 0.49 0 0.89-0.4 0.89-0.89v-5.06c0-0.98 0.8-1.79 1.79-1.79h2.23c0.99 0 1.79 0.8 1.79 1.79v5.06c0 0.49 0.4 0.89 0.89 0.89 0.49 0 0.89-0.4 0.89-0.89v-3.24c0-0.52 0.92-1.07 1.79-1.07h2.23c0.99 0 1.79 0.8 1.79 1.79V77.94z"/></svg>';
				break;

			case 'swipe-up':
				return '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><line fill="#000000" x1="40.07" y1="32.28" x2="40.07" y2="45.69"/><path fill="#000000" d="M40.07 46.58c-0.49 0-0.89-0.4-0.89-0.89V32.28c0-0.49 0.4-0.89 0.89-0.89 0.49 0 0.9 0.4 0.9 0.89v13.41C40.97 46.18 40.56 46.58 40.07 46.58z"/><path fill="#000000" d="M37.39 35.85c-0.23 0-0.46-0.09-0.63-0.26 -0.35-0.35-0.35-0.91 0-1.26l2.68-2.68c0.34-0.33 0.93-0.33 1.26 0l2.68 2.68c0.35 0.35 0.35 0.92 0 1.26 -0.35 0.35-0.91 0.35-1.26 0l-2.05-2.05 -2.05 2.05C37.85 35.77 37.62 35.85 37.39 35.85z"/><path fill="#000000" d="M41.09 59.45c-1.98 0.31-4.08-0.28-5.6-1.81 -2.53-2.53-2.53-6.64 0-9.16 2.53-2.53 6.64-2.53 9.16 0 1.52 1.52 2.12 3.62 1.81 5.6l1.48 1.48c0.9-2.85 0.23-6.09-2.03-8.35 -3.22-3.22-8.47-3.22-11.69 0 -3.22 3.23-3.22 8.47 0 11.69 2.26 2.25 5.5 2.93 8.35 2.03C42.05 60.41 41.56 59.92 41.09 59.45z"/><path fill="#000000" d="M68.9 48.08l-1.58 1.58c-0.44 0.45-0.79 1.01-1 1.61 -1.39-0.98-3.34-0.85-4.58 0.4l-1.58 1.58c-0.52 0.52-0.85 1.16-0.98 1.84 -1.33-0.63-2.97-0.4-4.07 0.7l-1.58 1.58c-0.46 0.46-0.77 1.02-0.92 1.6l-9.22-9.22c-1.83-1.83-4.81-1.83-6.64 0 -1.83 1.83-1.83 4.81 0 6.64l17.5 17.5c-0.37 1.05-0.58 2.16-0.58 3.3v2.59c0 5.42 4.41 9.83 9.83 9.83h7.22c0.35 0 0.7-0.02 1.05-0.06 3.27 0.87 6.92 0.02 9.49-2.55l8.85-8.85c3.83-3.83 3.85-10.06 0.03-13.88L73.96 48.08C72.56 46.68 70.3 46.68 68.9 48.08zM88.89 65.53c3.12 3.12 3.11 8.21-0.03 11.35l-8.85 8.85c-1.04 1.04-2.3 1.73-3.63 2.08 -1.11 0.28-2.5 0.45-4.46-0.09 -1.19-0.37-2.31-1.02-3.25-1.96 -0.35-0.35-0.92-0.35-1.26 0 -0.35 0.35-0.35 0.92 0 1.26 0.29 0.29 0.59 0.55 0.9 0.8h-4.79c-4.44 0-8.04-3.61-8.04-8.04V77.18c0-0.64 0.08-1.26 0.23-1.86l4.33 4.33c0.35 0.35 0.92 0.35 1.26 0 0.35-0.35 0.35-0.91 0-1.26L38.02 55.12c-1.13-1.13-1.13-2.98 0-4.11 1.13-1.13 2.98-1.13 4.11 0l16.24 16.23c0.35 0.35 0.92 0.35 1.26 0 0.35-0.35 0.35-0.91 0-1.26l-4.83-4.83c-0.7-0.7-0.7-1.83 0-2.53l1.58-1.58c0.7-0.7 1.83-0.7 2.53 0l4.84 4.84c0.35 0.35 0.91 0.35 1.26 0 0.35-0.35 0.35-0.91 0-1.26l-3.58-3.58c-0.7-0.7-0.7-1.83 0-2.53l1.58-1.58c0.7-0.7 1.83-0.7 2.53 0l3.57 3.57c0.35 0.35 0.92 0.35 1.26 0 0.35-0.35 0.35-0.91 0-1.26l-2.29-2.29c-0.37-0.37-0.11-1.41 0.51-2.02l1.58-1.58c0.7-0.7 1.83-0.7 2.53 0L88.89 65.53z"/></svg>';
				break;

			case 'arrow':
				return '<svg xmlns="http://www.w3.org/2000/svg"  x="0" y="0" width="24" height="42" viewBox="0 0 24 42" enable-background="new 0 0 24 42" xml:space="preserve"><polygon fill="dark" points="23.3 20.1 23.3 20.1 23.3 20.1 20.1 23.3 20.1 23.3 3.1 40.3 0 37.1 17 20.1 0 3.1 3.1 0 20.1 17 20.1 17 "/></svg>';
				break;

		}
		
	}

}

?>