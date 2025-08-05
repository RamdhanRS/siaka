<?php
$dynamicScripts = [];

function addScript($scriptTag)
{
  global $dynamicScripts;
  $dynamicScripts[] = $scriptTag;
}

function printScripts()
{
  global $dynamicScripts;
  foreach ($dynamicScripts as $script) {
    echo $script . "\n";
  }
}

function renderPagination($currentPage, $totalPages)
{
  if ($totalPages <= 1) return; // Tidak perlu pagination

  // Previous button
  if ($currentPage > 1) {
    echo '<a href="?page=' . ($currentPage - 1) . '" class="pagination-nav">« Prev</a>';
  }

  // Tampilkan halaman pertama
  if ($currentPage > 2) {
    echo '<a href="?page=1" class="pagination-page">1</a>';
    if ($currentPage > 3) {
      echo '<span class="pagination-dots">...</span>';
    }
  }

  // Halaman sekitar current
  for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++) {
    $active = ($i == $currentPage) ? 'active' : '';
    echo '<a href="?page=' . $i . '" class="pagination-page ' . $active . '">' . $i . '</a>';
  }

  // Halaman terakhir
  if ($currentPage < $totalPages - 1) {
    if ($currentPage < $totalPages - 2) {
      echo '<span class="pagination-dots">...</span>';
    }
    echo '<a href="?page=' . $totalPages . '" class="pagination-page">' . $totalPages . '</a>';
  }

  // Next button
  if ($currentPage < $totalPages) {
    echo '<a href="?page=' . ($currentPage + 1) . '" class="pagination-nav">Next »</a>';
  }
}
