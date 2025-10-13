@extends('layouts.app')

@section('title', 'Travel Guide for Andaman Ferry Booking Online')
@section('meta_title', 'Travel Guide for Andaman Ferry Booking Online')
@section('meta_description', 'Travel Guide for Andaman Ferry Booking Online: Learn how to book ferries, compare operators, and plan smooth island travel to Havelock, Neil, and more.
')

@section('content') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* Modern Animations & Transitions */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hero Banner with Gradient Overlay */
.modern-hero {
    position: relative;
    background: linear-gradient(135deg, rgba(20, 30, 48, 0.9), rgba(36, 59, 85, 0.8)), 
                url('your-background-image.jpg') center/cover;
    min-height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.modern-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.03) 50%, transparent 70%);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.hero-content {
    text-align: center;
    z-index: 2;
    position: relative;
}

.hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    animation: slideInUp 0.8s ease-out;
}

.hero-content p {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.9);
    max-width: 600px;
    margin: 0 auto;
    animation: slideInUp 0.8s ease-out 0.2s both;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Modern Breadcrumbs */
.modern-breadcrumb {
    background: white;
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #6366f1;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #4f46e5;
    transform: translateX(3px);
}

/* Main Content Container */
.main-content {
    padding: 3rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 70vh;
}

/* Modern Blog Cards */
.blog-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    padding: 2rem 3rem;
    margin-left: 0;
    margin-right: 0;
    align-items: center;
    text-decoration: none;
    color: inherit;
    display: block;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    text-decoration: none;
    color: inherit;
}

.blog-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
    transform: scaleX(0);
    transition: transform 0.4s ease;
    z-index: 2;
}

.blog-card:hover::before {
    transform: scaleX(1);
}

.blogInfo {
    padding: 2.5rem 5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    min-height: 200px;
}

.blog-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.blog-card:hover .blog-image {
    transform: scale(1.1);
}

.blog-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.1) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.blog-card:hover .blog-image-overlay {
    opacity: 1;
}

.blog-content {
    padding: 1.5rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.blog-card .col-lg-4,
.blog-card .col-md-5,
.blog-card .col-12:first-child {
    padding: 0;
}

.blog-card .col-lg-8,
.blog-card .col-md-7,
.blog-card .col-12:last-child {
    padding: 0;
}

.blog-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-size: 0.875rem;
    margin-bottom: 1rem;
    font-weight: 500;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.blog-meta i {
    color: #6366f1;
}

.blog-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    line-height: 1.4;
    transition: color 0.3s ease;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    letter-spacing: -0.025em;
}

.blog-card:hover .blog-title {
    color: #6366f1;
}

.blog-excerpt {
    color: #64748b;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    font-size: 1rem;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: 400;
    letter-spacing: 0.01em;
}

.blog-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #6366f1;
    font-weight: 600;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
    border: 1px solid rgba(99, 102, 241, 0.2);
}

.read-more-btn:hover {
    color: #4f46e5;
    gap: 0.75rem;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.15));
    border-color: rgba(99, 102, 241, 0.3);
    text-decoration: none;
}

.read-more-btn i {
    transition: transform 0.3s ease;
    font-size: 0.875rem;
}

.blog-card:hover .read-more-btn i {
    transform: translateX(3px);
}

.blog-date {
    color: #94a3b8;
    font-size: 0.875rem;
    font-weight: 500;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Modern Sidebar */
.sidebar {
    position: sticky;
    top: 2rem;
}

.sidebar-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
    transition: all 0.3s ease;
}

.sidebar-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.sidebar-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.sidebar-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #6366f1, #8b5cf6);
    border-radius: 2px;
}

/* Modern Search Bar */
.modern-search {
    position: relative;
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #e2e8f0;
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8fafc;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.search-input:focus {
    outline: none;
    border-color: #6366f1;
    background: white;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    transition: color 0.3s ease;
}

.search-input:focus + .search-icon {
    color: #6366f1;
}

/* Modern Load More Button */
.load_more {
    margin: 3rem 0;
}

.load-more-btn {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    border: none;
    padding: 1rem 2.5rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.load-more-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s;
}

.load-more-btn:hover::before {
    left: 100%;
}

.load-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
}

.load-more-btn:active {
    transform: translateY(0);
}

.loader-icon {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1.1rem;
    }
    
    .blogInfo {
        padding: 2rem 2.5rem;
        min-height: 180px;
    }
    
    .sidebar-card {
        padding: 1.5rem;
    }
    
    .blog-title {
        font-size: 1.25rem;
    }
    
    .blog-excerpt {
        font-size: 0.95rem;
    }
    
    .blog-card-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}

/* Animation for page load */
.animate-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

.animate-in:nth-child(1) { animation-delay: 0.1s; }
.animate-in:nth-child(2) { animation-delay: 0.2s; }
.animate-in:nth-child(3) { animation-delay: 0.3s; }
.animate-in:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<main>
    <!-- Modern Hero Banner -->
    <div class="modern-hero">
        <div class="hero-content">
            <h1>Travel Articles</h1>
            <p>Discover amazing stories and insights about Andaman's hidden gems</p>
        </div>
    </div>

    <!-- Modern Breadcrumbs -->
    <div class="modern-breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Travel Articles</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <!-- Blog Articles Section -->
                <div class="col-lg-8 col-12">
                    @php
                        // Debug: Let's see what data structure we have
                        // echo '<pre>'; print_r($data); echo '</pre>';
                    @endphp
                    
                    @if(!empty($data) && count($data) > 0)
                        @foreach($data as $key=>$val)
                            @if($key < 5)
                            <div class="blog-card blog-item" data-index="{{ $key }}">
                                <div class="row">
                                    <div class="col-12 blogInfo">
                                        <div>
                                            <p class="blog-meta">
                                                <i class="fas fa-user"></i> {{$val->author_name}}
                                            </p>
                                            <h3 class="blog-title">{!! html_entity_decode($val->title) !!}</h3>
                                            <p class="blog-excerpt">
                                                @php
                                                    $excerpt = strip_tags(html_entity_decode($val->subtitle));
                                                    $excerpt = preg_replace('/\s+/', ' ', trim($excerpt));
                                                    $words = explode(' ', $excerpt);
                                                    $limitedWords = array_slice($words, 0, 30);
                                                    echo implode(' ', $limitedWords) . (count($words) > 30 ? '...' : '');
                                                @endphp
                                            </p>
                                        </div>
                                        <div class="blog-card-footer">
                                            <span class="blog-date">
                                                <i class="fas fa-calendar-alt"></i> {{ date("dS M, Y",strtotime($val->created_at)) }}
                                            </span>
                                            <a href="{{ url('blog/'.$val->id) }}" class="read-more-btn">
                                                Read More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        
                        @if(count($data) > 5)
                        <!-- Load More Button -->
                        <div class="text-center load_more" id="append_before">
                            <button type="button" id="load_more" class="load-more-btn">
                                <span id="button_loader" style="display: none;">
                                    <i class="fas fa-spinner loader-icon"></i> Loading...
                                </span>
                                <span id="button_text">
                                    <i class="fas fa-plus"></i> Load More Articles
                                </span>
                            </button>
                            <input type="hidden" name="page_no" id="page_no" value="1">
                            <input type="hidden" name="total_blogs" id="total_blogs" value="{{ count($data) }}">
                            <input type="hidden" name="blogs_per_page" id="blogs_per_page" value="5">
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                            <h3 style="color: #64748b;">No articles found</h3>
                            <p style="color: #94a3b8;">Check back later for new travel stories!</p>
                        </div>
                    @endif
                </div>

                <!-- Modern Sidebar -->
                <div class="col-lg-4 col-12">
                    <div class="sidebar">
                        <!-- Search Section -->
                        <div class="sidebar-card animate-in">
                            <h3 class="sidebar-title">Search Articles</h3>
                            <form id="search_form" name="search_form" method="GET">
                                <div class="modern-search">
                                    <input type="search" 
                                           name="search_txt" 
                                           id="search_txt" 
                                           placeholder="Search for articles..." 
                                           class="search-input"
                                           value="{{ (!empty($_GET['search_txt']))?$_GET['search_txt']:'' }}" 
                                           oninput="searchclear();">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                            </form>
                        </div>

                        <!-- You can add more sidebar widgets here -->
                        <div class="sidebar-card animate-in">
                            <h3 class="sidebar-title">Popular Destinations</h3>
                            <div class="popular-tags">
                                <span class="tag">Havelock Island</span>
                                <span class="tag">Neil Island</span>
                                <span class="tag">Port Blair</span>
                                <span class="tag">Radhanagar Beach</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Additional Styles for Tags -->
<style>
.popular-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag {
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    color: #475569;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.tag:hover {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    transform: translateY(-2px);
}
</style>

@endsection

@push('js')
<script>
function searchclear() {
    var search_txt = $("#search_txt").val();
    if($.trim(search_txt) == '') {
        $("#search_form").submit();
    }
}

$(document).ready(function() {
    $('#button_loader').hide();
}); 

$(document).on('click', "#load_more", function(e) {
    var page_no = parseInt($('#page_no').val());
    var total_blogs = parseInt($('#total_blogs').val());
    var blogs_per_page = parseInt($('#blogs_per_page').val());
    var current_shown = page_no * blogs_per_page;
    
    $('#button_loader').show();
    $('#button_text').hide();
    
    // Simulate loading delay for better UX
    setTimeout(function() {
        // Get all blog data from the page
        var allBlogs = @json($data);
        var start_index = current_shown;
        var end_index = Math.min(start_index + blogs_per_page, total_blogs);
        
        // Create HTML for new blogs
        var newBlogsHTML = '';
        for(var i = start_index; i < end_index; i++) {
            if(allBlogs[i]) {
                var blog = allBlogs[i];
                var excerpt = blog.subtitle;
                // Strip HTML tags and limit to 30 words
                excerpt = excerpt.replace(/<[^>]*>/g, '');
                excerpt = excerpt.replace(/\s+/g, ' ').trim();
                var words = excerpt.split(' ');
                var limitedWords = words.slice(0, 30);
                excerpt = limitedWords.join(' ') + (words.length > 30 ? '...' : '');
                
                var date = new Date(blog.created_at);
                var formattedDate = date.getDate() + getOrdinalSuffix(date.getDate()) + ' ' + 
                                   date.toLocaleDateString('en-US', {month: 'short'}) + ', ' + 
                                   date.getFullYear();
                
                newBlogsHTML += `
                    <div class="blog-card blog-item" data-index="${i}">
                        <div class="row">
                            <div class="col-12 blogInfo">
                                <div>
                                    <p class="blog-meta">
                                        <i class="fas fa-user"></i> ${blog.author_name}
                                    </p>
                                    <h3 class="blog-title">${blog.title}</h3>
                                    <p class="blog-excerpt">${excerpt}</p>
                                </div>
                                <div class="blog-card-footer">
                                    <span class="blog-date">
                                        <i class="fas fa-calendar-alt"></i> ${formattedDate}
                                    </span>
                                    <a href="/blog/${blog.id}" class="read-more-btn">
                                        Read More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }
        
        // Insert new blogs before the load more button
        if(newBlogsHTML) {
            $(newBlogsHTML).insertBefore('#append_before');
            $('#page_no').val(page_no + 1);
        }
        
        // Hide load more button if all blogs are shown
        if(end_index >= total_blogs) {
            $('#load_more').hide();
        }
        
        $('#button_loader').hide();
        $('#button_text').show();
        
    }, 300);
});

function getOrdinalSuffix(day) {
    if (day > 3 && day < 21) return 'th';
    switch (day % 10) {
        case 1: return 'st';
        case 2: return 'nd';
        case 3: return 'rd';
        default: return 'th';
    }
}
</script>
@endpush