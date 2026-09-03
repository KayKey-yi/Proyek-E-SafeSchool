<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Lost &amp; Found Diterima - {{ config('app.name', 'E-Safe School') }}</title>

	<style>
		:root {
			--blue-900: #173f72;
			--blue-700: #2468ad;
			--blue-600: #2a5fb0;
			--blue-100: #eaf4ff;
			--card-bg: #dfeeff;
			--blue-border: #9db9e8;
			--ink: #18324b;
			--muted: #60758a;
			--page-bg: #eef4f3;
		}

		* {
			box-sizing: border-box;
		}

		body {
			min-height: 100vh;
			margin: 0;
			color: var(--ink);
			background: var(--page-bg);
			font-family: "Segoe UI", Arial, sans-serif;
		}

		/* Navbar */
		.navbar {
			display: flex;
			align-items: center;
			gap: 14px;
			background: #ffffff;
			padding: 14px 22px;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
		}

		.navbar .hamburger {
			font-size: 1.3rem;
			color: var(--ink);
			line-height: 1;
			cursor: pointer;
		}

		.navbar .brand {
			display: flex;
			align-items: center;
			gap: 8px;
			font-weight: 700;
			color: var(--blue-900);
			font-size: 1rem;
		}

		/* Content */
		.content {
			display: grid;
			place-items: center;
			padding: 48px 20px 32px;
		}

		.page-wrap {
			width: min(100%, 860px);
			margin: 0 auto;
		}

		/* Kotak utama BESAR */
		.confirmation {
			width: 100%;
			height: 400px;
			padding: 46px 40px;
			border: 1px solid var(--blue-border);
			border-radius: 8px;
			background: var(--card-bg);
			text-align: center;

			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		/* Icon */
		.icon-shield {
			width: 84px;
			height: 84px;
			margin: 0 auto 18px;
			color: var(--blue-700);
		}

		.icon-shield img {
	    width: 100%;
	    height: 100%;
	    object-fit: contain;
	    display: block;
	    mix-blend-mode: multiply;
}

		/* Tulisan */
		h1 {
			margin: 0;
			color: #173fbc;
			font-size: clamp(0.9rem, 2vw, 1.3rem);
			font-weight: 800;
			letter-spacing: 0.3px;
			text-transform: uppercase;
			line-height: 1.5;
			white-space: nowrap;
		}

		/* Tombol */
		.actions {
			display: flex;
			justify-content: center;
			align-items: center;

			/* tombol dibuat renggang */
			gap: 100px;

			margin-top: 22px;
			flex-wrap: wrap;
		}

		.btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;

			padding: 12px 26px;
			min-width: 145px;

			border-radius: 5px;
			font-size: 0.85rem;
			font-weight: 750;
			text-decoration: none;

			border: 2px solid var(--blue-600);
			transition: opacity 0.15s ease;
		}

		.btn:hover {
			opacity: 0.85;
		}

		.btn-primary {
			background: var(--blue-600);
			color: #fff;
		}

		.btn-outline {
			background: #fff;
			color: var(--blue-600);
			
		}

		@media (max-width: 480px) {

			.content {
				padding: 35px 20px 32px;
			}

			.confirmation {
				height: 260px;
				padding: 30px 20px;
			}

			.icon-shield {
				width: 70px;
				height: 70px;
			}

			h1 {
				font-size: 0.8rem;
				white-space: normal;
			}

			.actions {
				gap: 15px;
				flex-direction: column;
			}

			.btn {
				width: 145px;
			}
		}
	</style>
</head>

<body>

	<nav class="navbar">
		<span class="hamburger">&#9776;</span>

		<span class="brand">
			<img
				src="{{ asset('images/Safe.png') }}"
				alt="Logo E-Safe School"
				style="width:40px;height:40px;object-fit:contain;"
			>
			E-Safe School
		</span>
	</nav>

	<main class="content">

		<div class="page-wrap">

			<div class="confirmation" aria-labelledby="confirmation-title">

				<div class="icon-shield" aria-hidden="true">
					<img
						src="{{ asset('images/Safe.png') }}"
						alt="Logo E-Safe School"
					>
				</div>

				<h1 id="confirmation-title">
					Terima kasih, laporan Anda telah diterima
				</h1>

			</div>

			<div class="actions">

				<a href="#" class="btn btn-primary">
					Pantau Status Laporan
				</a>

				<a href="{{ route('frontend.index') }}" class="btn btn-outline">
    Halaman Utama
</a>

			</div>

		</div>

	</main>

</body>
</html>