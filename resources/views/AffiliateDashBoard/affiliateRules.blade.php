@extends ('AffiliateDashBoard.affmaster')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Affiliate Rules</h2>
        <p>All the rules and guidelines for affiliates are listed here.</p>
    </div>
</div>

<style>
    .rule-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }
    .rule-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 5px;
    }
    .rule-description {
        font-size: 0.95rem;
        color: #555;
    }
</style>  

<main class="mt-4">
    <div class="container px-4"> 
        <div class="row">
            @foreach($rules as $rule)
                <div class="col-md-12">
                    <div class="rule-card">
                        <div class="rule-title">Rule #{{ $loop->iteration }}</div>
                        <p class="rule-description">{{ $rule->rule }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
