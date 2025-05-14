<section id="faq" class="faq">

    <div class="container">
        <div class="faq-container">
            <div class="faq-item faq-active">

                <h3><span>Currently Borrowed By</span></h3>


                <div class="faq-content">
                    @forelse($borrowings as $borrowing)
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Expected Date Returned</th>
                            </tr>
                            <tr>
                                <td>{{ $this->obfuscateName($borrowing->users) }}</td>
                                <td>{{ \Carbon\Carbon::parse($borrowing->borrowingReturn->returned_at)->format('F d, Y') }}
                                </td>
                            </tr>
                        </table>

                    @empty
                        <p>No active borrowers for this item.</p>
                    @endforelse
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
            </div>
        </div>
    </div>

</section>
