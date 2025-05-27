<?php

namespace App\Http\Controllers;
use App\Models\AffiliateRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AffiliateRulesController extends Controller
{
    public function showrules() 
    {
        $rules = AffiliateRule::all(); 
        return view('AffiliateDashBoard.affiliateRules', compact('rules'));
    }


    public function index()
    {
        $rules = AffiliateRule::all(); 
        return view('AdminDashboard.affiliate_rules', compact('rules'));
    }



    public function store(Request $request)
    {
        
            $request->validate([
                'rule' => 'required|string|max:255',
            ]);
        
            AffiliateRule::create([
                'rule' => $request->rule,
            ]);
        
            return redirect()->route('affiliate_rules')->with('success', 'Rule added successfully.');
    }
    
    
    public function update(Request $request, $id)
    {
            $affiliateRule = AffiliateRule::findOrFail($id);
            $affiliateRule->rule = $request->rule;
            $affiliateRule->save();
    
            return redirect()->route('affiliate_rules')->with('success', 'Rule updated successfully.');
    }
    


    public function destroy($id)
    {
        $rule = AffiliateRule::findOrFail($id);
        $rule->delete();

        return redirect()->route('affiliate_rules')->with('success', 'Rule deleted successfully.');
    }



      


}


