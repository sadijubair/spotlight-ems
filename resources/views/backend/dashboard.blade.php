@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endpush

@section('content')
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
   <div class="col">
	 <div class="card radius-10 border-start border-0 border-4 border-info">
		<div class="card-body">
			<div class="d-flex align-items-center">
				<div>
					<p class="mb-0 text-secondary">Total Students</p>
					<h4 class="my-1 text-info">4805</h4>
					<p class="mb-0 font-13">+2.5% from last week</p>
				</div>
				<div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
				</div>
			</div>
		</div>
	 </div>
   </div>
   <div class="col">
	<div class="card radius-10 border-start border-0 border-4 border-danger">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total Boys Students</p>
				   <h4 class="my-1 text-danger">2405</h4>
				   <p class="mb-0 font-13">+5.4% from last week</p>
			   </div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div>
  <div class="col">
	<div class="card radius-10 border-start border-0 border-4 border-success">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total Girls Students</p>
				   <h4 class="my-1 text-success">2400</h4>
				   <p class="mb-0 font-13">-4.5% from last week</p>
			   </div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div>
  <div class="col">
	<div class="card radius-10 border-start border-0 border-4 border-warning">
	   <div class="card-body">
		   <div class="d-flex align-items-center">
			   <div>
				   <p class="mb-0 text-secondary">Total Teachers</p>
				   <h4 class="my-1 text-warning">8.4K</h4>
				   <p class="mb-0 font-13">+8.4% from last week</p>
			   </div>
			   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
			   </div>
		   </div>
	   </div>
	</div>
  </div> 
</div><!--end row-->

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 bg-primary bg-gradient">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Notices</p>
										<h4 class="my-1 text-white">{{ $totalNotices }}</h4>
										<p class="mb-0 font-13 text-white-50">{{ $publishedNotices }} Published</p>
									</div>
									<div class="text-white ms-auto font-35"><i class='bx bx-notification'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-danger bg-gradient">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total News</p>
										<h4 class="my-1 text-white">{{ $totalNews }}</h4>
										<p class="mb-0 font-13 text-white-50">{{ $publishedNews }} Published</p>
									</div>
									<div class="text-white ms-auto font-35"><i class='bx bx-news'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-warning bg-gradient">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-dark">Total Blogs</p>
										<h4 class="text-dark my-1">{{ $totalBlogs }}</h4>
										<p class="mb-0 font-13 text-dark-50">{{ $publishedBlogs }} Published</p>
									</div>
									<div class="text-dark ms-auto font-35"><i class='bx bx-edit'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-success bg-gradient">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Content</p>
										<h4 class="my-1 text-white">{{ $totalNotices + $totalNews + $totalBlogs }}</h4>
										<p class="mb-0 font-13 text-white-50">All Published Items</p>
									</div>
									<div class="text-white ms-auto font-35"><i class='bx bx-collection'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
</div><!--end row-->

<div class="row">
   <div class="col-12 col-lg-8 d-flex">
      <div class="card radius-10 w-100">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<div>
					<h6 class="mb-0">Sales Overview</h6>
				</div>
				<div class="dropdown ms-auto">
					<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="javascript:;">Action</a>
						</li>
						<li><a class="dropdown-item" href="javascript:;">Another action</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="javascript:;">Something else here</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		  <div class="card-body">
			<div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
				<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
				<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>
			</div>
			<div class="chart-container-1">
				<canvas id="chart1"></canvas>
			  </div>
		  </div>
		  <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
			<div class="col">
			  <div class="p-3">
				<h5 class="mb-0">24.15M</h5>
				<small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
			  </div>
			</div>
			<div class="col">
			  <div class="p-3">
				<h5 class="mb-0">12:38</h5>
				<small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
			  </div>
			</div>
			<div class="col">
			  <div class="p-3">
				<h5 class="mb-0">639.82</h5>
				<small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
			  </div>
			</div>
		  </div>
	  </div>
   </div>
   <div class="col-12 col-lg-4 d-flex">
       <div class="card radius-10 w-100">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<div>
					<h6 class="mb-0">Trending Products</h6>
				</div>
				<div class="dropdown ms-auto">
					<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="javascript:;">Action</a>
						</li>
						<li><a class="dropdown-item" href="javascript:;">Another action</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="javascript:;">Something else here</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		   <div class="card-body">
			<div class="chart-container-2">
				<canvas id="chart2"></canvas>
			  </div>
		   </div>
		   <ul class="list-group list-group-flush">
			<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Jeans <span class="badge bg-success rounded-pill">25</span>
			</li>
			<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">T-Shirts <span class="badge bg-danger rounded-pill">10</span>
			</li>
			<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Shoes <span class="badge bg-primary rounded-pill">65</span>
			</li>
			<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Lingerie <span class="badge bg-warning text-dark rounded-pill">14</span>
			</li>
		</ul>
	   </div>
   </div>
</div><!--end row-->

<div class="card radius-10">
	<div class="card-header">
		<div class="d-flex align-items-center">
			<div>
				<h6 class="mb-0">Recent Orders</h6>
			</div>
			<div class="dropdown ms-auto">
				<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
				</a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="javascript:;">Action</a>
					</li>
					<li><a class="dropdown-item" href="javascript:;">Another action</a>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="javascript:;">Something else here</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	 <div class="card-body">
	 <div class="table-responsive">
	   <table class="table align-middle mb-0">
		<thead class="table-light">
		 <tr>
		   <th>Product</th>
		   <th>Photo</th>
		   <th>Product ID</th>
		   <th>Status</th>
		   <th>Amount</th>
		   <th>Date</th>
		   <th>Shipping</th>
		 </tr>
		 </thead>
		 <tbody><tr>
		  <td>Iphone 5</td>
		  <td><img src="{{ asset('backend/assets/images/products/01.png') }}" class="product-img-2" alt="product img"></td>
		  <td>#9405822</td>
		  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
		  <td>$1250.00</td>
		  <td>03 Feb 2020</td>
		  <td><div class="progress" style="height: 6px;">
				<div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
			  </div></td>
		 </tr>
	
		 <tr>
		  <td>Earphone GL</td>
		  <td><img src="{{ asset('backend/assets/images/products/02.png') }}" class="product-img-2" alt="product img"></td>
		  <td>#8304620</td>
		  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
		  <td>$1500.00</td>
		  <td>05 Feb 2020</td>
		  <td><div class="progress" style="height: 6px;">
				<div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
			  </div></td>
		 </tr>
	
		 <tr>
		  <td>HD Hand Camera</td>
		  <td><img src="{{ asset('backend/assets/images/products/03.png') }}" class="product-img-2" alt="product img"></td>
		  <td>#4736890</td>
		  <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
		  <td>$1400.00</td>
		  <td>06 Feb 2020</td>
		  <td><div class="progress" style="height: 6px;">
				<div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 70%"></div>
			  </div></td>
		 </tr>
	
		 <tr>
		  <td>Clasic Shoes</td>
		  <td><img src="{{ asset('backend/assets/images/products/04.png') }}" class="product-img-2" alt="product img"></td>
		  <td>#8543765</td>
		  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
		  <td>$1200.00</td>
		  <td>14 Feb 2020</td>
		  <td><div class="progress" style="height: 6px;">
				<div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
			  </div></td>
		 </tr>
		 <tr>
		  <td>Sitting Chair</td>
		  <td><img src="{{ asset('backend/assets/images/products/06.png') }}" class="product-img-2" alt="product img"></td>
		  <td>#9629240</td>
		  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
		  <td>$1500.00</td>
		  <td>18 Feb 2020</td>
		  <td><div class="progress" style="height: 6px;">
				<div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
			  </div></td>
		 </tr>
		</tbody>
	   </table>
	 </div>
	 </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
@endpush
